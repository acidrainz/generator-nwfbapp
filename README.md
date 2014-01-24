# CodeIgniter Facebook App Generator

Credits to [Tiago Vasconcelos](https://github.com/tisvasconcelos)

A generator for Yeoman, this generator create a codeigniter (php framework) structure with facebook API integration.

## Getting started
- Make sure you have [yo](https://github.com/yeoman/yo) installed:
    `npm install -g yo`
- Install the generator: `npm install -g generator-nwfbapp`
- Run: `yo nwfbapp`

## Important

#### This generator will create a CodeIgniter (Version 2.1.4) structure, with some changes:

- Added facebook configuration


## Configuration

#### When you run the generator, you have to answer some questions:

- Project Name (default: Project Name)
- Prject URL (default: http://localhost/)
- Database hostname (default: 127.0.0.1:3306)
- Database username (default: root)
- Database password (default: root)
- Database name (default: database_name)
- App ID (default: APP ID)
- App Secret (default: APP SECRET)
- Fan Page URL (default: Fan Page URL)
- Fan Page ID (default: Fan Page ID)
- Timezone (default: Asia/Manila)

These settings are in the file CONFIG.ini, located in the project root, you can change it at any time.

#### Obs.: You will see that CONFIG.ini have the template path, you can changed if you need.

## Memory Cache

### Last but not least

To avoid reading CONFIG.ini to each request, if you have memcache installed on the server and enabled in PHP will be used to cache the project settings, to remove this cache access memcache via terminal and delete the key entered during installation, or change the key ($ memcache_key) within the index.php file.

#### Obs.: The cache is set to expire in 15 days.

Links:

- [http://memcached.org/](http://memcached.org/)
- [http://www.php.net/manual/en/book.memcache.php](http://www.php.net/manual/en/book.memcache.php)

## License
[MIT License](http://en.wikipedia.org/wiki/MIT_License)
