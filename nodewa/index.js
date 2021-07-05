const { Client } = require("whatsapp-web.js");
const qrcode = require("qrcode");
const axios = require("axios");
const fs = require("fs");

const express = require("express");
const app = express();
const http = require("http");
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server);
const PORT = 3000;

// server listening
server.listen(PORT, function () {
  console.log(`listening on http://localhost:${PORT}`);
});

// route
app.get("/", (req, res) => {
  res.sendFile(__dirname + "/index.html");
});

// Whatssap Session
const SESSION_FILE_PATH = "./session.json";
let sessionCfg;
if (fs.existsSync(SESSION_FILE_PATH)) {
  sessionCfg = require(SESSION_FILE_PATH);
}

// Whatsapp Web instance
const client = new Client({
  puppeteer: { headless: true },
  session: sessionCfg,
});

client.initialize();

// socket io
io.on("connection", (socket) => {
  console.log("io connected");
  socket.emit("message", "Please Wait");
  client.on("qr", (qr) => {
    // Membuat QR CODE WA untuk koneksi
    qrcode.toDataURL(qr, (err, url) => {
      socket.emit("qr", url);
      socket.emit("message", "QR Code Received!");
    });
  });
  // Membuat Session agar saat tidak scan ulang QR CODE
  client.on("authenticated", (session) => {
    socket.emit("message", "Authenticated!");
    sessionCfg = session;
    fs.writeFile(SESSION_FILE_PATH, JSON.stringify(session), function (err) {
      if (err) {
        console.error(err);
      }
    });
  });
  // Klo muncul pesan error, file session.json coba di hapus
  client.on("auth_failure", (msg) => {
    socket.emit("message", "Authentication Failed!");
    console.error("AUTHENTICATION FAILURE", msg);
  });
  // Sudah terkoneksi
  client.on("ready", () => {
    socket.emit("message", "Client Is Ready!");
  });
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
