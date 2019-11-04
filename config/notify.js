const fs = require('fs');
const recursive = require("recursive-readdir");
const fm = require('front-matter');

// Read all posts
recursive('../src/_posts', function (err, files) {
  if (err) throw err;
  files.forEach( file => {
    fs.readFile(file, 'utf-8', (err, data) => {
      if (err) throw err;
      const content = fm(data);
      console.log(content);
    });
  });
});