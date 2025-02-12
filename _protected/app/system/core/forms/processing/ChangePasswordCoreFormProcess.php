<?php
/**
 * @author         Pierre-Henry Soria <hello@ph7builder.com>
 * @copyright      (c) 2012-2019, Pierre-Henry Soria. All Rights Reserved.
 * @license        MIT License; See LICENSE.md and COPYRIGHT.md in the root directory.
 * @package        PH7 / App / System / Core / Form / Processing
 */

namespace PH7;

defined('PH7') or exit('Restricted access');

use PH7\Framework\Mvc\Request\Http;

/** For "user", "affiliate" and "admin" modules **/
class ChangePasswordCoreFormProcess extends Form
{
    private bool $bIsAdminModule;

    /**
     * @internal Need to use Http::NO_CLEAN arg in Http::post() since password might contains special character like "<" and will otherwise be converted to HTML entities
     */
    public function __construct()
    {
        parent::__construct();

        $this->bIsAdminModule = AdminCore::isAdminPanel();

        $this->executePasswordChanging();
    }

    /**
     * @throws Framework\Mvc\Request\WrongRequestMethodException
     */
    private function executePasswordChanging(): void
    {
        $oPasswordModel = $this->getPasswordModel();

        $sEmail = $this->getUserEmail();
        $sTable = $this->getTableName();

        // Login
        if ($this->bIsAdminModule) {
            $mLogin = $oPasswordModel->adminLogin(
                $sEmail,
                $this->session->get('admin_username'),
                $this->httpRequest->post('current_password', Http::NO_CLEAN)
            );
        } else {
            $mLogin = $oPasswordModel->login(
                $sEmail,
                $this->httpRequest->post('current_password', Http::NO_CLEAN),
                $sTable
            );
        }

        // Check
        if ($this->httpRequest->post('new_password', Http::NO_CLEAN) !== $this->httpRequest->post('new_password2', Http::NO_CLEAN)) {
            \PFBC\Form::setError('form_change_password', t("The passwords don't match."));
        } elseif ($this->httpRequest->post('current_password', Http::NO_CLEAN) === $this->httpRequest->post('new_password', Http::NO_CLEAN)) {
            \PFBC\Form::setError('form_change_password', t('Your current and new passwords are identical. So why do you want to change it?'));
        } elseif ($mLogin !== true) {
            \PFBC\Form::setError('form_change_password', t("Your current password isn't correct."));
        } else {
            // Regenerate the session ID to prevent session fixation attack
            $this->session->regenerateId();

            // Update the password
            $oPasswordModel->changePassword(
                $sEmail,
                $this->httpRequest->post('new_password', Http::NO_CLEAN),
                $sTable
            );

            \PFBC\Form::setSuccess(
                'form_change_password',
                t('Your password has been successfully changed.')
            );
        }
    }

    private function getUserEmail(): string
    {
        if ($this->registry->module === 'user') {
            return $this->session->get('member_email');
        }

        if ($this->bIsAdminModule) {
            return $this->session->get('admin_email');
        }

        return $this->session->get('affiliate_email');
    }

    private function getTableName(): string
    {
        if ($this->registry->module === 'user') {
            return DbTableName::MEMBER;
        }

        if ($this->bIsAdminModule) {
            return DbTableName::ADMIN;
        }

        return DbTableName::AFFILIATE;
    }

    /**
     * @internal PH7\UserCoreModel::login() method of the UserCoreModel works only for "user" and "affiliate" module.
     */
    private function getPasswordModel(): UserCoreModel
    {
        $sClassName = $this->bIsAdminModule ? AdminModel::class : UserCoreModel::class;

        return new $sClassName;
    }
}
