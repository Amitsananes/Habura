<?php
use BracketSpace\Notification\Interfaces\Triggerable;
use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\Field;

/**
 * ExampleCarrier Carrier
 */
class ExampleCarrier extends Abstracts\Carrier {

	/**
	 * Carrier icon, optional
	 *
	 * @var string SVG
	 */
	public $icon = '<svg width="138" height="32" viewBox="0 0 138 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.9297 26.7115C24.8027 25.3515 27.5892 21.7035 27.5892 17.4118C27.5892 11.9624 23.1083 7.52943 17.6 7.52943C12.0917 7.52943 7.61082 11.9624 7.61082 17.4118C7.61082 22.049 10.8606 25.937 15.2216 26.9958V27.9652C10.325 26.8904 6.65947 22.5798 6.65947 17.4118C6.65947 11.4344 11.558 6.58825 17.6 6.58825C23.642 6.58825 28.5406 11.4344 28.5406 17.4118C28.5406 22.2391 25.3421 26.321 20.9297 27.7148V26.7115ZM17.6 12.2353C14.7146 12.2353 12.3676 14.5572 12.3676 17.4118C12.3676 19.4165 13.533 21.1454 15.2217 22.0038V23.0503C12.9888 22.1289 11.4163 19.9548 11.4163 17.4118C11.4163 14.0329 14.1847 11.2941 17.6 11.2941C21.0154 11.2941 23.7838 14.0329 23.7838 17.4118C23.7838 19.5746 22.6422 21.4663 20.9298 22.5534V21.3826C22.0866 20.4329 22.8325 19.0118 22.8325 17.4118C22.8325 14.5572 20.4855 12.2353 17.6 12.2353ZM0 17.4118C0 23.5256 3.19083 28.8932 8.00943 32C8.30054 31.8118 8.59927 31.6348 8.90084 31.4635C9.1168 31.3421 9.33466 31.2264 9.55632 31.1134C9.8208 30.9788 10.0891 30.8508 10.3612 30.7294C10.6323 30.608 10.9063 30.4951 11.185 30.3868C11.4115 30.2993 11.6398 30.2174 11.871 30.1384C12.1935 30.0282 12.5207 29.9275 12.8528 29.8353C13.102 29.7666 13.3532 29.7016 13.6072 29.6433C13.864 29.584 14.1219 29.5285 14.3835 29.4805C14.6613 29.4296 14.94 29.3816 15.2216 29.3431C15.5375 29.3111 15.8524 29.2734 16.173 29.248V28.1327V27.1812V23.3591V22.3878V18.8235H15.2216V16.9412H16.173H19.027H19.9784V22.0169V23.0588V26.9995V27.9708V29.3421C22.6117 29.7064 25.0595 30.6259 27.1887 31.9991C32.0092 28.8932 35.2 23.5256 35.2 17.4118C35.2 7.79576 27.32 0 17.6 0C7.88004 0 0 7.79576 0 17.4118Z" fill="white"></path></svg>';

	/**
	 * Carrier constructor
	 */
	public function __construct() {
		// Provide the slug and translatable name.
		parent::__construct( 'os-carrier', __( 'OneSignal Carrier', 'textdomain' ) );
	}

	/**
	 * Used to register Carrier form fields
	 * Uses $this->add_form_field();
	 *
	 * @return void
	 */
	public function form_fields() {

		$this->add_form_field( new Field\InputField( [
			'label' => __( 'Title', 'notification' ),
			'name'  => 'text',
		] ) );

		$this->add_form_field( new Field\InputField( [
                        'label' => __( 'Body', 'notification' ),
                        'name'  => 'title',
                ] ) );


		// Special field which renders all Carrier's recipients.
		// You may override name, slug and description here.

	}

	/**
	 * Sends the notification
	 *
	 * @param  Triggerable $trigger trigger object.
	 * @return void
	 */
	public function send( Triggerable $trigger ) {
		// Data contains the user data with rendered Merge Tags.
		$data = $this->data;

		// Parsed recipients are also available.
		$data['parsed_recipients'];

		file_put_contents('not',$data);
	}

}
