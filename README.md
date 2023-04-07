# Q2A Terms of Service

Allow specifying terms of service (ToS) for your Question2Answer site that users
must agree to when registering an account or posting anonymously (if your site
allows anonymous posts).

After installation the plugin creates a new empty Question2Answer page where you
can enter your terms of service. Once ToS are defined (i.e. the content field of
the page isn't empty), the Terms &amp; Conditions checkbox on the registration
form is automatically enabled.

If you already have a page with terms of service, you can forgo the automatic
page creation by setting the Question2Answer option `tos_page_id` to the ID of
your existing page before installing the plugin, e.g.:

    INSERT INTO qa_options (title, content) VALUES ("tos_page_id", 42);

Replace 42 with the actual ID of your existing page.

## Installation

Copy the plugin directory to the plugins directory of your Question2Answer site
(or clone this repository there), then log in as the site admin and enable the
plugin under *Admin&nbsp;&rarr; Plugins*.

## License

This plugin is free software licensed under the [GNU General Public License
version 3.0][1] (see [LICENSE][2]).

`SPDX-License-Identifier: GPL-3.0-or-later`

## About Question2Answer

Question2Answer is a free and open source platform for Q&A sites. For more
information, visit:

https://www.question2answer.org/

[1]: https://www.gnu.org/licenses/gpl-3.0.en.html
[2]: /LICENSE
