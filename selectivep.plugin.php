<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); }

class SelectiveP extends Plugin
{
	public function filter_post_content_atom($content, $post) {
		if($this->should_pee($post->content_type)) {
			$content = Format::autop($content);
		}
		return $content;
	}

	public function filter_post_content_out($content, $post) {
		if($this->should_pee($post->content_type)) {
			$content = Format::autop($content);
		}
		return $content;
	}

	public function filter_comment_content_out($content, $post) {
		if($this->should_pee('comment')) {
			$content = Format::autop($content);
		}
		return $content;
	}

	public function should_pee($type) {
		$types = Options::get('selectivep_types');
		return in_array($type, $types);
	}

	public function configure() {
		$form = new FormUI('selectivep');
		$options = array_flip(Post::list_active_post_types());
		unset($options[0]);
		$form->append(new FormControlCheckboxes('post_types', 'selectivep_types', 'Post types that should autop', $options));
		$form->append(new FormControlSubmit('save', 'Save'));
		return $form;
	}
}

?>
