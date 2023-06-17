<?php
/*
	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
	GNU General Public License for more details.

	More about this license: https://www.gnu.org/licenses/gpl-3.0.html
*/

class qa_html_theme_layer extends qa_html_theme_base {

	public function initialize() {
		qa_html_theme_base::initialize();

		# create new empty ToS page if it doesn't exist
		if (qa_opt('tos_page_id') === '') {
			debug_out('create tos page');
			require_once QA_INCLUDE_DIR.'db/admin.php';
			$title   = qa_lang('tos/title');
			$slug    = qa_lang('tos/urlslug');
			$heading = qa_lang('tos/heading');
			$pageid  = qa_db_page_create($title, 0, $slug, $heading, '', QA_PERMIT_ALL);
			qa_opt('tos_page_id', $pageid);
		}

		# automatically enable ToS registration checkbox if it hasn't been enabled
		# and the ToS page is not empty
		if (qa_opt('show_register_terms') != 1 and !$this->tos_empty()) {
			qa_opt('register_terms', '<p>' . $this->insert_page_link('tos/register_terms') . '</p>');
			qa_opt('show_register_terms', 1);
		}
	}

	public function form($form) {
		$userinput_titles = [
			qa_lang_html('question/your_answer_title'),
			qa_lang_html('question/your_comment_a'),
			qa_lang_html('question/your_comment_q'),
		];
		if (!qa_is_logged_in() and ($this->template === 'ask' or ($this->template === 'question' and in_array($form['title'], $userinput_titles, true)))) {
			$form['fields'] += [
				'tos' => [
					'type'  => 'custom',
					'label' => $this->insert_page_link('tos/post_terms'),
				],
			];
		}
		qa_html_theme_base::form($form);
	}

	private function insert_page_link($identifier) {
		$pageid     = qa_opt('tos_page_id');
		$result     = qa_db_read_one_assoc(qa_db_query_sub('SELECT title,tags FROM ^pages WHERE pageid=#;', $pageid));
		$tos_path   = qa_path($result['tags'], null, qa_path_to_root());
		$title      = qa_html($result['title']);
		$subst_text = empty($tos_path) ? $title : ('<a href="' . qa_html($tos_path) . '">$1</a>');
		return preg_replace('/\^1(.*?)\^2/', $subst_text, qa_lang_html($identifier));
	}

	private function tos_empty() {
		$pageid = qa_opt('tos_page_id');
		$query  = 'SELECT count(*) FROM ^pages WHERE pageid=# AND (content IS NULL OR trim(content)="");';
		$result = qa_db_read_one_value(qa_db_query_sub($query, $pageid));
		return ($result != 0);
	}

}
