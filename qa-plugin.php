<?php
/*
  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  More about this license: https://www.gnu.org/licenses/gpl-3.0.html
*/

// don't allow this page to be requested directly from browser
if (!defined('QA_VERSION')) {
	header('Location: ../../');
	exit;
}

qa_register_plugin_layer('qa-tos-layer.php', 'Terms of Service');
qa_register_plugin_phrases('qa-tos-lang-*.php', 'tos');
