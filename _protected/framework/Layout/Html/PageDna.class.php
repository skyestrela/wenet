<?php
/**
 * @title            Page's DNA Generator
 *
 * @author           Pierre-Henry Soria <hello@ph7builder.com>
 * @copyright        (c) 2018-2021, Pierre-Henry Soria. All Rights Reserved.
 * @license          MIT License; See LICENSE.md and COPYRIGHT.md in the root directory.
 * @package          PH7 / Framework / Layout / Html
 */

namespace PH7\Framework\Layout\Html;

defined('PH7') or exit('Restricted access');

final class PageDna
{
    const COMMENT_PH7CMS = <<<COMMENT
        \n<!--

            m    m mmmmmm   mmm  m    m  mmmm
     mmmm   #    #     #" m"   " ##  ## #"   "
     #" "#  #mmmm#    m"  #      # ## # "#mmm
     #   #  #    #   m"   #      # "" #     "#
     ##m#"  #    #  m"     "mmm" #    # "mmm#"
     #
     "

     🚀 Everything you Need to Create & Launch Your Own Social/Dating WebApp => https://pH7Builder.com
     https://github.com/pH7Software/pH7-Social-Dating-CMS

-->\n
COMMENT;

    const COMMENT_PH7BUILDER = <<<COMMENT
        \n<!--
     mmmmmmmmmmmmmmmmmmm
     | ❤️ pH7Builder 🚀 |
     mmmmmmmmmmmmmmmmmmm
        \   &__&
         \  (oo)\_______
            (__)\       )\/\
               !!    w !!
               !!      !!

    💡 ✓ Build your SOCIAL DATING Web APP ⬇ (in just 45 minutes)
    https://github.com/pH7Software/pH7-Social-Dating-CMS
-->\n
COMMENT;

    const COMMENT_BUILT_WITH_PH7CMS = <<<COMMENT
        \n<!--
     BUILT WITH pH7Builder – https://ph7builder.com
     https://github.com/pH7Software/pH7-Social-Dating-CMS


            m    m mmmmmm   mmm  m    m  mmmm
     mmmm   #    #     #" m"   " ##  ## #"   "
     #" "#  #mmmm#    m"  #      # ## # "#mmm
     #   #  #    #   m"   #      # "" #     "#
     ##m#"  #    #  m"     "mmm" #    # "mmm#"
     #
     "

    Enjoy! ❤️ https://pH7Builder.com
-->\n
COMMENT;

    const COMMENT_FOR_YOU = <<<COMMENT
        \n<!--

    mmmmmmm #        "
       #    # mm   mmm     mmm
       #    #"  #    #    #   "
       #    #   #    #     """m
       #    #   #  mm#mm  "mmm"

    m     m        #               "      m
    #  #  #  mmm   #mmm    mmm   mmm    mm#mm   mmm
    " #"# # #"  #  #" "#  #   "    #      #    #"  #
     ## ##" #""""  #   #   """m    #      #    #""""
     #   #  "#mm"  ##m#"  "mmm"  mm#mm    "mm  "#mm"

     mmmmmm                     m     m                 m
     #       mmm    m mm         "m m"   mmm   m   m    #
     #mmmmm #" "#   #"  "         "#"   #" "#  #   #    #
     #      #   #   #              #    #   #  #   #    "
     #      "#m#"   #              #    "#m#"  "mm"#    #

     HERE YOU GO! 😍 => https://pH7Builder.com
     https://github.com/pH7Software/pH7-Social-Dating-CMS

-->\n
COMMENT;

    const COMMENT_SOCIAL_DATING_SOFTWARE = <<<COMMENT
        \n<!--
     💪 BUILT WITH pH7Builder ❤️ – https://ph7builder.com

      mmmm                  "           ""#
     #"   "  mmm    mmm   mmm     mmm     #
     "#mmm  #" "#  #"  "    #    "   #    #
         "# #   #  #        #    m"""#    #
     "mmm#" "#m#"  "#mm"  mm#mm  "mm"#    "mm

     mmmm            m      "
     #   "m  mmm   mm#mm  mmm    m mm    mmmm
     #    # "   #    #      #    #"  #  #" "#
     #    # m"""#    #      #    #   #  #   #
     #mmm"  "mm"#    "mm  mm#mm  #   #  "#m"#
                                         m  #
                                          ""

      mmmm           m""    m
     #"   "  mmm   mm#mm  mm#mm m     m  mmm    m mm   mmm
     "#mmm  #" "#    #      #   "m m m" "   #   #"  " #"  #
         "# #   #    #      #    #m#m#  m"""#   #     #""""
     "mmm#" "#m#"    #      "mm   # #   "mm"#   #     "#mm"

     EVERYTHING Your BUSINESS NEEDS to Create & Launch a SOCIAL/DATING WebApp => https://pH7Builder.com
     https://github.com/pH7Software/pH7-Social-Dating-CMS
-->\n
COMMENT;

    const COMMENTS = [
        self::COMMENT_PH7CMS,
        self::COMMENT_PH7BUILDER,
        self::COMMENT_BUILT_WITH_PH7CMS,
        self::COMMENT_FOR_YOU,
        self::COMMENT_SOCIAL_DATING_SOFTWARE
    ];

    /**
     * Generates HTML DNA comments.
     *
     * @return string
     */
    public static function generateHtmlComment()
    {
        return self::COMMENTS[array_rand(self::COMMENTS)];
    }
}
