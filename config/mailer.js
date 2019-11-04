const fs = require('fs');
const nodemailer = require('nodemailer');
const users = JSON.parse(fs.readFileSync('./users.json', 'utf-8'));


module.exports = (password) => {
  if(password){
    let transport = nodemailer.createTransport({
      host: 'smtp.googlemail.com', // Gmail Host
      port: 465, // Port
      secure: true, // this is true as port is 465
      auth: {
         user: 'guillaumeduran2@gmail.com',
         pass: password
      }
    });

    const message = {
      from: 'guillaumeduran2@gmail.com', // Sender address
      to: 'guillaumeduran2@gmail.com',         // List of recipients
      subject: 'Nouveaux dessins disponibles!', // Subject line
      text: 'Je viens de publier de nouveaux dessins. Tu peux les voir à cette adresse: https://guizput.github.io/gd/.' // Plain text body
    };

    transport.sendMail(message, (err, info) => {
        if (err) {
          console.log(err)
        } else {
          console.log(info);
        }
    });
  }
}

