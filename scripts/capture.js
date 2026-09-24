import puppeteer from 'puppeteer-core';
import { execSync } from 'child_process';
import path from 'path';
import fs from 'fs';

const BASE_URL = 'http://127.0.0.1:8000';
const SCREENSHOT_DIR = 'C:\\xampp\\htdocs\\lpdp-app\\screenshots';
const CHROME_PATH = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';

function runArtisan(cmd) {
  try {
    const output = execSync(`php artisan tinker --execute="${cmd}"`, {
      cwd: 'C:\\xampp\\htdocs\\lpdp-app',
      encoding: 'utf-8'
    });
    return output;
  } catch (err) {
    console.error('Artisan error:', err.message);
    return null;
  }
}

async function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

async function capture(page, url, filename, options = {}) {
  const filePath = path.join(SCREENSHOT_DIR, filename);
  console.log(`Capturing: ${filename} from ${url}`);
  try {
    if (url) {
      await page.goto(url, { waitUntil: 'networkidle2', timeout: 30000 });
    }
    await sleep(options.delay || 1200);

    if (options.action) {
      await options.action(page);
      await sleep(1000);
    }

    await page.screenshot({
      path: filePath,
      fullPage: options.fullPage !== undefined ? options.fullPage : false
    });
    console.log(`Saved: ${filename}`);
  } catch (e) {
    console.error(`Failed to capture ${filename}:`, e.message);
  }
}

async function main() {
  if (!fs.existsSync(SCREENSHOT_DIR)) {
    fs.mkdirSync(SCREENSHOT_DIR, { recursive: true });
  }

  const browser = await puppeteer.launch({
    executablePath: CHROME_PATH,
    headless: true,
    args: [
      '--no-sandbox',
      '--disable-setuid-sandbox',
      '--disable-gpu',
      '--window-size=1440,900'
    ],
    defaultViewport: {
      width: 1440,
      height: 900,
      deviceScaleFactor: 1
    }
  });

  const page = await browser.newPage();

  console.log('--- PHASE 1: PUBLIC PAGES ---');
  await capture(page, `${BASE_URL}/`, '01-landing-page.png');
  await capture(page, `${BASE_URL}/syarat-pendaftaran`, '02-syarat-pendaftaran.png');
  await capture(page, `${BASE_URL}/buku-panduan`, '03-buku-panduan.png');
  await capture(page, `${BASE_URL}/register`, '04-register-user.png');
  await capture(page, `${BASE_URL}/verify-otp`, '05-verifikasi-otp.png');
  await capture(page, `${BASE_URL}/login`, '06-login-user.png');
  await capture(page, `${BASE_URL}/lupa-password`, '07-lupa-password.png');

  console.log('--- PHASE 2: USER LOGIN & DASHBOARD ---');
  await page.goto(`${BASE_URL}/login`, { waitUntil: 'networkidle2' });
  await page.type('input[name="email"], input[type="email"]', 'skyfoxmarket@gmail.com');
  await page.type('input[name="password"], input[type="password"]', 'password123');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'networkidle2' }),
    page.keyboard.press('Enter')
  ]);

  await capture(page, `${BASE_URL}/dashboard`, '08-user-dashboard.png');
  await capture(page, `${BASE_URL}/pendaftaran`, '17-pendaftaran-selesai.png');
  await capture(page, `${BASE_URL}/riwayat`, '18-riwayat-pendaftaran.png');
  await capture(page, `${BASE_URL}/notifikasi`, '19-user-notifikasi.png');
  await capture(page, `${BASE_URL}/profile`, '20-user-profile.png');

  console.log('--- PHASE 3: MULTI-STEP FORMS (STEP 1 - 7) ---');
  // Temporarily set status to draft
  runArtisan(`$u = App\\Models\\UserProfile::where('user_id', 1)->first(); if($u){ $u->status = 'draft'; $u->save(); }`);

  await capture(page, `${BASE_URL}/pendaftaran/kategori`, '09-pilih-kategori.png');
  await capture(page, `${BASE_URL}/pendaftaran/step/1`, '10-step1-profil-ktp.png');
  await capture(page, `${BASE_URL}/pendaftaran/step/2`, '11-step2-industri-pekerjaan.png');
  await capture(page, `${BASE_URL}/pendaftaran/step/3`, '12-step3-universitas-loa.png');
  await capture(page, `${BASE_URL}/pendaftaran/step/4`, '13-step4-surat-rekomendasi.png');
  await capture(page, `${BASE_URL}/pendaftaran/step/5`, '14-step5-essay-kontribusi.png');
  await capture(page, `${BASE_URL}/pendaftaran/step/6`, '15-step6-surat-komitmen.png');
  await capture(page, `${BASE_URL}/pendaftaran/step/7`, '16-step7-ringkasan-finalize.png');

  // Restore status to pending
  runArtisan(`$u = App\\Models\\UserProfile::where('user_id', 1)->first(); if($u){ $u->status = 'pending'; $u->save(); }`);

  console.log('--- PHASE 4: ADMIN PANEL ---');
  const adminContext = await browser.createBrowserContext();
  const adminPage = await adminContext.newPage();
  await adminPage.setViewport({ width: 1440, height: 900 });

  await capture(adminPage, `${BASE_URL}/admin/login`, '21-admin-login.png');

  await adminPage.goto(`${BASE_URL}/admin/login`, { waitUntil: 'networkidle2' });
  await adminPage.type('input[name="email"], input[type="email"]', 'msyaifulloh2024@gmail.com');
  await adminPage.type('input[name="password"], input[type="password"]', 'tes12345');
  await Promise.all([
    adminPage.waitForNavigation({ waitUntil: 'networkidle2' }),
    adminPage.keyboard.press('Enter')
  ]);

  await capture(adminPage, `${BASE_URL}/admin/dashboard`, '22-admin-dashboard.png');
  await capture(adminPage, `${BASE_URL}/admin/pendaftar`, '23-admin-pendaftar-list.png');

  // Click on first applicant card to open details
  await capture(adminPage, null, '24-admin-verifikasi-detail.png', {
    action: async (p) => {
      try {
        const toggleBtn = await p.$('div.cursor-pointer, button[type="button"]');
        if (toggleBtn) {
          await toggleBtn.click();
        }
      } catch (err) {
        console.log('Toggle detail error:', err.message);
      }
    }
  });

  await capture(adminPage, `${BASE_URL}/admin/pendaftar/infoPendaftar`, '25-admin-info-pendaftar.png');
  await capture(adminPage, `${BASE_URL}/admin/audit-logs`, '26-admin-audit-logs.png');
  await capture(adminPage, `${BASE_URL}/admin/notifikasi`, '27-admin-notifikasi.png');
  await capture(adminPage, `${BASE_URL}/admin/settings`, '28-admin-settings.png');

  console.log('--- PHASE 5: PDF SUMMARY EXPORT ---');
  await capture(adminPage, `${BASE_URL}/admin/pendaftar/1/pdf`, '29-export-pdf-ringkasan.png');

  console.log('Done capturing screenshots!');
  await browser.close();
}

main().catch((err) => {
  console.error('Fatal error:', err);
  process.exit(1);
});
