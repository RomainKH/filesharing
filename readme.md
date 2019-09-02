# File Sharing Tool

Hi! I've created this project for an internship I did in the summer of 2019. Basically it's a Dropbox-like and it is fully coded in php and js, just a small use of jquery for ajax usage.

To set-up the project you have to go & modify setup.php & config.php in `./assets/` and then just run the project on a local server or server.
Then in order to complete the set-up you need to build a database this way

&nbsp;

![database exemple](https://raw.githubusercontent.com/RomainKH/filesharing/master/database.png)

## Features

* You can upload multiple or single file, the tool will allow you to download it either both of each files or all in one zip archive.
* You can choose how much time the file is gonna be available for everyone, up to 2 weeks.
* You can see the percentage of the file being uploaded.
* Errors are managed either before uploading or after, if you try to upload a big file it will tell you if you can or not, and if there is an error like the name of the file or something went wrong during the uploading of the file it will tell you.
* You can also rename each file (done via ajax), which allows you to custom as you want the files you upload.
* Sharing the file via e-mail is in WIP and is possible with modifying the smtp server in php.ini.
* Every it of the database is encrypted and cannot be cracked.
* The way files are uploaded follows the POST / REDIRECT / GET method.
* To a certain extent files are displayed in download page (videos, pdf, images, etc).
