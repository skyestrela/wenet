<?php
/**
 * @author         Pierre-Henry Soria <hello@ph7builder.com>
 * @copyright      (c) 2012-2022, Pierre-Henry Soria. All Rights Reserved.
 * @license        MIT License; See LICENSE.md and COPYRIGHT.md in the root directory.
 * @package        PH7 / App / System / Module / Xml / Controller
 */

declare(strict_types=1);

namespace PH7;

use PH7\Datatype\Type;
use PH7\Framework\Mvc\Router\Uri;
use PH7\Framework\Xml\Exception as XmlException;
use PH7\Framework\Xml\Link;

class RssController extends MainController implements XmlControllable
{
    private const RSS_TYPE = 'rss';

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->sTitle = t('RSS Feed List');
        $this->view->page_title = $this->sTitle;
        $this->view->meta_description = t('RSS Feed %site_name%, Free Online Dating Site with Video Chat Rooms, Meet Single People with %site_name%');
        $this->view->h1_title = $this->sTitle;

        /*** Get the links ***/
        $sUrl = Uri::get('xml', 'rss', 'xmllink');

        try {
            $this->view->urls = (new Link($sUrl))->get();
        } catch (XmlException $oExcept) {
            $this->view->error = $oExcept->getMessage();
        }

        $this->output();
    }

    public function xmlLink(): void
    {
        parent::xmlLink();

        $this->view->display('rss_links.xml.tpl');
    }

    public function xmlRouter(): void
    {
        $sAction = $this->httpRequest->get('action', Type::STRING);
        $mParam = $this->httpRequest->get('param');
        $this->generateXmlRouter($sAction, $mParam);
        $this->sXmlType = self::RSS_TYPE;
        $this->view->current_date = DateFormat::getRss(); // Date format for RSS feed

        // RSS router
        $this->generateRssCommentRouter($sAction, $mParam);

        $this->xmlOutput();
    }

    /**
     * @param string $sAction
     * @param mixed $mParam
     *
     * @return void
     */
    private function generateRssCommentRouter(string $sAction, $mParam): void
    {
        switch ($sAction) {
            case 'blog':
            case 'note':
            case 'forum-topic':
                $this->sAction = $sAction;
                break;

            case 'comment-profile':
            case 'comment-blog':
            case 'comment-note':
            case 'comment-picture':
            case 'comment-video':
                // We disable the cache because of dynamic pages managed by the router
                $this->view->setCaching(
                    false
                );
                $this->sAction = 'comment.inc';
                break;

            case 'forum-post':
                if ($this->isParamValid($mParam)) {
                    // We disable the cache since they are dynamic pages managed by the router
                    $this->view->setCaching(false);
                    $this->view->forums_messages = $this->oDataModel->getForumsMessages($mParam);
                    $this->sAction = $sAction;
                } else {
                    $this->displayPageNotFound(t('Invalid RSS Feed URL.'));
                }
                break;

            default:
                $this->displayPageNotFound(t('RSS Feed Not Found!'));
        }
    }
}
