<?php
/**
 * ownCloud - spreedwebrtc
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Leon <leon@struktur.de>
 * @copyright Leon 2015
 */

namespace OCA\SpreedWebRTC\Controller;

use OCA\SpreedWebRTC\Security\Security;
use OCA\SpreedWebRTC\Settings\Settings;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;

class PageController extends Controller {

	public function __construct($appName, IRequest $request, $userId) {
		parent::__construct($appName, $request);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
		return $this->webRTC();
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function webRTC() {
		$params = [];
		$response = new TemplateResponse(Settings::APP_ID, 'webrtc', $params);

		// Allow to embed iframes
		$csp = new ContentSecurityPolicy();
		//$csp->addAllowedFrameDomain('*');
		$csp->addAllowedFrameDomain(implode(',', Security::getAllowedIframeDomains()));
		$response->setContentSecurityPolicy($csp);

		return $response;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function fileSelector() {
		$params = [];
		$response = new TemplateResponse(Settings::APP_ID, 'fileselector', $params, 'empty');

		return $response;
	}

	/**
	 * @NoCSRFRequired
	 */
	public function displayChangelog() {
		$params = ['since' => $since];
		$response = new TemplateResponse(Settings::APP_ID, 'changelog', $params, 'empty');

		return $response;
	}

}
