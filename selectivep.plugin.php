<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); }

class SelectiveP extends Plugin
{
	public function filter_post_content_atom($content, $post) {
		if($this->should_pee('P-' . $post->typename)) {
			$content = Format::autop($content);
		}
		return $content;
	}

	public function filter_post_content_out($content, $post) {
		if($this->should_pee('P-' . $post->typename)) {
			$content = Format::autop($content);
		}
		return $content;
	}

	public function filter_comment_content_out($content, $comment) {
		if($this->should_pee('C-' . $comment->typename)) {
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
		$options = array_combine(array_map(function($a){return 'P-' . $a;}, $options), array_map(function($a){return 'Post Type: ' . $a;}, $options));
		$comment_options = array_combine(Comment::list_comment_types(), Comment::list_comment_types());
		$comment_options = array_combine(array_map(function($a){return 'C-' . $a;}, $comment_options), array_map(function($a){return 'Comment Type: ' . $a;}, $comment_options));
		$options = array_merge($options, $comment_options);
		//$options['comment'] = 'Any Comment';
		$form->append(new FormControlStatic('prompt', 'Select the types that should have autop applied to their content:'));
		$form->append(new FormControlCheckboxes('post_types', 'selectivep_types', 'Post types that should autop', $options));
		$form->append(new FormControlSubmit('save', 'Save'));
		return $form;
	}
}

?>
