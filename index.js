const { Client } = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");
const axios = require("axios");
const fs = require("fs");
const { exit } = require("process");

const SESSION_FILE_PATH = "./session.json";
let sessionCfg;
if (fs.existsSync(SESSION_FILE_PATH)) {
  sessionCfg = require(SESSION_FILE_PATH);
}

const client = new Client({
  puppeteer: { headless: true },
  session: sessionCfg,
});

client.initialize();

client.on("qr", (qr) => {
  // Membuat QR CODE WA di terminal untuk koneksi
  console.log("QR RECEIVED", qr);
  qrcode.generate(qr, { small: true });
});

// Membuat Session agar saat tidak scan ulang QR CODE
client.on("authenticated", (session) => {
  console.log("AUTHENTICATED", session);
  sessionCfg = session;
  fs.writeFile(SESSION_FILE_PATH, JSON.stringify(session), function (err) {
    if (err) {
      console.error(err);
    }
  });
});

client.on("auth_failure", (msg) => {
  // Klo muncul pesa error begini, file session.json coba di hapus
  console.error("AUTHENTICATION FAILURE", msg);
});

client.on("ready", () => {
  console.log("Client is ready!");
});

client.on("message", async (msg) => {
  // Cek auto reply !ping
  if (msg.body == "!ping") {
    msg.reply("pong");
  }
  // form jika di submit, akan redirect ke halaman tersebut
  // https://api.whatsapp.com/send?phone={no.telp}&text=text

  // auto message dari form di atas
  // !daftar@Riko Putra Pratama@Jalan Malang

  // logika daftar
  else if (msg.body.startsWith("!daftar")) {
    let namaPel = msg.body.split("@")[1];
    let alamatPel = msg.body.split("@")[2];
    let noAwal = msg.from;
    let noPel = noAwal.split("@")[0];
    console.log("nama :" + namaPel);
    console.log("alamat :" + alamatPel);
    console.log("no telepon :" + noPel);

    // post ke database melalui api
    axios
      .post("https://lararentalmobil.000webhostapp.com/api/pelanggan", {
        nama: namaPel,
        telepon: noPel,
        alamat: alamatPel,
      })
      .then((res) => {
        console.log(`statusCode: ${res.statusCode}`);
        console.log(res.data);
        // cek data user sudah ada apa belum
        // res.data.status tergantung dari api
        // error = sudah terdaftar, success = belum terdaftar
        if (res.data.status == "error") {
          msg.reply(`
          Yth Bpk/Ibu 
          ${res.data.nama} 
          Jangan khawatir!
          Anda sudah menjadi member kami!
          Nantikan promo selanjutnya!
          
          Berikut data anda yg disimpan:
          Nama: ${res.data.nama}
          No Telepon: ${res.data.telepon}
          Alamat: ${res.data.alamat}

          Jangan khawatir!!
          Kami sangat menjaga privasi anda!
          `);
        } else if (res.data.status == "success") {
          msg.reply(`
          Yeah selamat!
          Berhasil menjadi member kami! 
          Nantikan promo selanjutnya!
          
          Berikut data anda yg disimpan:
          Nama: ${namaPel}
          No Telepon: ${noPel}
          Alamat: ${alamatPel}
          
          Jangan khawatir!!
          Kami sangat menjaga privasi anda!
          `);
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
});
