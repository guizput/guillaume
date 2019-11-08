const fs = require('fs');
const recursive = require("recursive-readdir");
const fm = require('front-matter');
const mailer = require('./mailer.js');
const read = require('read');

// Get users list
const users = fs.readFileSync('./users.json');
const users_content = JSON.parse(users);

// List of posts
let all_posts = [];
let current_posts = [];
let new_posts = [];
let separator = '';

// Get all posts
const getAllPosts = (path) => {
  recursive(path, function (err, files) {
    if (err) throw err;
    files.forEach( file => {
      let content = fs.readFileSync(file, 'utf-8');
      const data = fm(content);
      all_posts.push(data);
    });
    getCurrentPosts();
  });
}

// Get current posts
const getCurrentPosts = () => {
  let temp = fs.readFileSync('./posts.json', 'utf-8');
  current_posts = JSON.parse(temp);
  getNewPosts();
}

// Get new posts
const getNewPosts = () => {
  all_posts.forEach(post => {
    let curr = JSON.stringify(current_posts);
    let p = JSON.stringify(post);
    if(curr.indexOf(p) === -1) {
      new_posts.push(post);
      separator = ',';
    }
  });
  updatePostList();
}

// Update posts.json
const updatePostList = () => {
  let content = JSON.stringify(new_posts).replace('[', '').replace(']', '');
  fs.readFile('./posts.json', 'utf-8', (err, data) => {
    if (err) throw err;
    let new_content = '[' + data.replace('[', '').replace(']', '') + separator + content + ']';
    
    fs.writeFile('./posts.json', new_content.trim(), (err) => {
      if (err) throw err;
      read({prompt: "Notifier mes followers? (Y/N)"}, function (er, answer) {
        if(answer === 'Y' || answer === 'y' ){
          read({prompt: "Password: ", silent: true }, function (er, pass) {
            mailer(pass);
          })
        }
      });
    });
  });
}

getAllPosts('../src/_posts');


