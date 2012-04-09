<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); }

class SelectiveP extends Plugin
{
	public function filter_post_content_atom($content, $post) {
		if($this->should_pee($post->type)) {
			$content = Format::autop($content);
		}
		return $content;
	}

	public function filter_post_content_out($content, $post) {
		if($this->should_pee($post->type)) {
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

	}
}

?>
