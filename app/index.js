'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');

var nwfbapp = module.exports = function nwfbapp(args, options, config) {
  yeoman.generators.Base.apply(this, arguments);

  this.on('end', function () {
    this.installDependencies({ skipInstall: true });
  });

  this.pkg = JSON.parse(this.readFileAsString(path.join(__dirname, '../package.json')));
};

util.inherits(nwfbapp, yeoman.generators.Base);

nwfbapp.prototype.askFor = function askFor() {
  var cb = this.async();

  // have Yeoman greet the user.
  console.log(this.yeoman);

  var prompts = [
    {
      name: 'projectName',
      message: 'What do you want to call your project?'
    },
    {
      name: 'projectURL',
      message: 'Your project URL? (e.g.: http://localhost/)'
    },
    {
      name: 'dbHostname',
      message: 'Your database hostname? (e.g.: 127.0.0.1:3306)'
    },
    {
      name: 'dbUsername',
      message: 'Your database username? (e.g.: root)'
    },
    {
      name: 'dbPassword',
      message: 'Your database password? (e.g.: root)'
    },
    {
      name: 'dbDatabase',
      message: 'Your database name? (e.g.: database_name)'
    },
    {
      name: 'timeZone',
      message: 'Your time zone? (e.g.: America/Sao_Paulo)'
    },
    {
      name: 'app_id',
      message: 'Your App ID?'
    },
    {
      name: 'app_secret',
      message: 'Your  App secret key?'
    },
    {
      name: 'fan_page_id',
      message: 'Your Fan Page ID? '
    },
    {
      name: 'fb_url',
      message: 'Your time FB URL? '
    },
    {
      name: 'memoryName',
      message: 'These settings you just entered are cached in memory if you have memcache installed.\nEnter the name/key to save these settings: (e.g: config_project)'
    }
  ];

  this.prompt(prompts, function (props) {
    this.projectName = (props.projectName != "") ? props.projectName : "Project Name";
    this.projectURL = (props.projectURL != "") ? props.projectURL : "http://localhost/";
    this.dbHostname = (props.dbHostname != "") ? props.dbHostname : '127.0.0.1:3306';
    this.dbUsername = (props.dbUsername != "") ? props.dbUsername : 'root';
    this.dbPassword = (props.dbPassword != "") ? props.dbPassword : 'root';
    this.dbDatabase = (props.dbDatabase != "") ? props.dbDatabase : 'database_name';
    this.timeZone = (props.timeZone != "") ? props.timeZone : 'America/Sao_Paulo';
    this.memoryName = (props.memoryName != "") ? props.memoryName : 'config_project';

    cb();
  }.bind(this));
};

nwfbapp.prototype.app = function app() {
  this.directory('code-igniter/application', 'application');
  this.directory('code-igniter/system', 'system');
  this.directory('code-igniter/templates', 'templates');
  this.directory('code-igniter/css', 'css');
  this.directory('code-igniter/fonts', 'fonts');
  this.directory('code-igniter/images', 'images');
  this.directory('code-igniter/js', 'js');
  this.directory('code-igniter/administrator', 'administrator');
  this.directory('code-igniter/plugins', 'plugins');
  this.copy('_package.json', 'templates/package.json');
  this.directory('code-igniter/.htaccess', '.htaccess');
  this.copy('_htaccess', '.htaccess');
  this.template('code-igniter/admin.php', 'admin.php');
  this.template('code-igniter/data.sql', 'data.sql');
  this.template('code-igniter/index.php', 'index.php');
  this.copy('code-igniter/license.txt', 'license.txt');

  var configText
    = '[project]'
    + '\nname='+this.projectName
    + '\nurl='+this.projectURL
    + '\ntemplates=templates/default/'
    + '\n[database]'
    + '\nhost='+this.dbHostname
    + '\ndb='+this.dbDatabase
    + '\nuser='+this.dbUsername
    + '\npass='+this.dbPassword;
    + '\napp_id='+this.app_id;
    + '\nfan_page_id='+this.fan_page_id;
    + '\nfb_url='+this.fb_url;
    + '\napp_secret='+this.app_secret;


  this.write('CONFIG.ini', configText);
};

/*
nwfbapp.prototype.projectfiles = function projectfiles() {
  this.copy('editorconfig', '.editorconfig');
  this.copy('jshintrc', '.jshintrc');
};
*/
