[MIT Libraries News](http://libraries.mit.edu/news/) Wordpress Theme
========

[![Build Status](https://travis-ci.org/MITLibraries/MITLibraries-news.svg?branch=master)](https://travis-ci.org/MITLibraries/MITLibraries-news)
[![Code Climate](https://codeclimate.com/github/MITLibraries/MITLibraries-news/badges/gpa.svg)](https://codeclimate.com/github/MITLibraries/MITLibraries-news)
[![Issue Count](https://codeclimate.com/github/MITLibraries/MITLibraries-news/badges/issue_count.svg)](https://codeclimate.com/github/MITLibraries/MITLibraries-news)

This theme is used to display the MIT Libraries' news and events website, and the home of its Bibliotech newsletter. It is a child theme of [MITLibraries-parent](https://github.com/MITLibraries/MITLibraries-parent).

See the theme in action at [libraries.mit.edu/news](https://libraries.mit.edu/news).

## A note for developers and contributors:

Pull requests are evaluated by Travis-CI for syntax errors and security flaws using relevant sections of the WordPress Coding Standards. They are also evaluated by CodeClimate using static code analysis and linting provided by PHPCS and PHPMD. We expect that contributors are running those tools locally, or otherwise ensuring that pull requests conform to those standards. We have included the `codesniffer.local.xml` configuration for local use, which is typically invoked by the following command:

```
phpcs -psvn . --standard=./codesniffer.local.xml --extensions=php --report=source --report=full
```
