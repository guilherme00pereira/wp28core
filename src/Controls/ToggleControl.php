<?php

namespace WP28\SKUMANAGER\Lib\WP28Core\Controls;

class ToggleControl extends HtmlControl {

	/**
	 * @param string $id
	 * @param string $label
	 * @param string $value
	 */
	public function __construct( string $id, string $label, string $value ) {
	    parent::__construct($id, $label, $value);
	}

	public function render_html() {
		?>
        <div class="form-control">
            <label class="cursor-pointer label">
                <span class="label-text"><?php echo $this->label ?>></span>
                <input name="options[<?php echo $this->id ?>]" id="<?php echo $this->id ?>"
                       type="checkbox" value="1" <?php checked(isset($this->value)) ?> class="toggle toggle-primary">
            </label>
        </div>
		<?php
	}
}