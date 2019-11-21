const mailer = require('./mailer.js');
const readline = require('readline');
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question('Notifier mes followers? (Y/N)', answer => {
  if(answer === 'Y' || answer === 'y' ){
    rl.question('Password: ', pass => {
      mailer(pass);
      process.stdin.destroy();
    });
  }else {
    process.stdin.destroy();
  }
});


