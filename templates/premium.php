<?php
/**
 * Premium Tab
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Eu Energy Label
 * @version 1.0.1
 */

/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
?>

<style>
    .section{
        margin-left: -20px;
        margin-right: -20px;
        font-family: "Raleway",san-serif;
    }
    .section h1{
        text-align: center;
        text-transform: uppercase;
        color: #808a97;
        font-size: 35px;
        font-weight: 700;
        line-height: normal;
        display: inline-block;
        width: 100%;
        margin: 50px 0 0;
    }
    .section ul{
        list-style-type: disc;
        padding-left: 15px;
    }
    .section:nth-child(even){
        background-color: #fff;
    }
    .section:nth-child(odd){
        background-color: #f1f1f1;
    }
    .section .section-title img{
        display: table-cell;
        vertical-align: middle;
        width: auto;
        margin-right: 15px;
    }
    .section h2,
    .section h3 {
        display: inline-block;
        vertical-align: middle;
        padding: 0;
        font-size: 24px;
        font-weight: 700;
        color: #808a97;
        text-transform: uppercase;
    }

    .section .section-title h2{
        display: table-cell;
        vertical-align: middle;
        line-height: 25px;
    }

    .section-title{
        display: table;
    }

    .section h3 {
        font-size: 14px;
        line-height: 28px;
        margin-bottom: 0;
        display: block;
    }

    .section p{
        font-size: 13px;
        margin: 25px 0;
    }
    .section ul li{
        margin-bottom: 4px;
    }
    .landing-container{
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        padding: 50px 0 30px;
    }
    .landing-container:after{
        display: block;
        clear: both;
        content: '';
    }
    .landing-container .col-1,
    .landing-container .col-2{
        float: left;
        box-sizing: border-box;
        padding: 0 15px;
    }
    .landing-container .col-1 img{
        width: 100%;
    }
    .landing-container .col-1{
        width: 55%;
    }
    .landing-container .col-2{
        width: 45%;
    }
    .premium-cta{
        background-color: #808a97;
        color: #fff;
        border-radius: 6px;
        padding: 20px 15px;
    }
    .premium-cta:after{
        content: '';
        display: block;
        clear: both;
    }
    .premium-cta p{
        margin: 7px 0;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        width: 60%;
    }
    .premium-cta a.button{
        border-radius: 6px;
        height: 60px;
        float: right;
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>upgrade.png) #ff643f no-repeat 13px 13px;
        border-color: #ff643f;
        box-shadow: none;
        outline: none;
        color: #fff;
        position: relative;
        padding: 9px 50px 9px 70px;
    }
    .premium-cta a.button:hover,
    .premium-cta a.button:active,
    .premium-cta a.button:focus{
        color: #fff;
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>upgrade.png) #971d00 no-repeat 13px 13px;
        border-color: #971d00;
        box-shadow: none;
        outline: none;
    }
    .premium-cta a.button:focus{
        top: 1px;
    }
    .premium-cta a.button span{
        line-height: 13px;
    }
    .premium-cta a.button .highlight{
        display: block;
        font-size: 20px;
        font-weight: 700;
        line-height: 20px;
    }
    .premium-cta .highlight{
        text-transform: uppercase;
        background: none;
        font-weight: 800;
        color: #fff;
    }

    .section.one{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>01-bg.png) no-repeat #fff; background-position: 85% 75%
    }
    .section.two{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>02-bg.png) no-repeat #fff; background-position: 85% 75%
    }
    .section.three{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>03-bg.png) no-repeat #fff; background-position: 85% 75%
    }
    .section.four{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>04-bg.png) no-repeat #fff; background-position: 85% 75%
    }
    .section.five{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>05-bg.png) no-repeat #fff; background-position: 85% 75%
    }
    .section.six{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>06-bg.png) no-repeat #fff; background-position: 85% 75%
    }
    .section.seven{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>07-bg.png) no-repeat #fff; background-position: 85% 75%
    }
    .section.eight{
        background: url(<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>08-bg.png) no-repeat #fff; background-position: 85% 75%
    }


    @media (max-width: 768px) {
        .section{margin: 0}
        .premium-cta p{
            width: 100%;
        }
        .premium-cta{
            text-align: center;
        }
        .premium-cta a.button{
            float: none;
        }
    }

    @media (max-width: 480px){
        .wrap{
            margin-right: 0;
        }
        .section{
            margin: 0;
        }
        .landing-container .col-1,
        .landing-container .col-2{
            width: 100%;
            padding: 0 15px;
        }
        .section-odd .col-1 {
            float: left;
            margin-right: -100%;
        }
        .section-odd .col-2 {
            float: right;
            margin-top: 65%;
        }
    }

    @media (max-width: 320px){
        .premium-cta a.button{
            padding: 9px 20px 9px 70px;
        }

        .section .section-title img{
            display: none;
        }
    }
</style>
<div class="landing">
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    <?php echo sprintf( __('Upgrade to %1$spremium version%2$s of %1$sYITH WooCommerce Uploads%2$s to benefit from all features!','wceue'),'<span class="highlight">','</span>' );?>
                </p>
                <a href="<?php echo $this->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight"><?php _e('UPGRADE','wceue');?></span>
                    <span><?php _e('to the premium version','wceue');?></span>
                </a>
            </div>
        </div>
    </div>
    <div class="one section section-even clear">
        <h1><?php _e('Premium Features','wceue');?></h1>
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>01.png" alt="<?php _e( 'FILTER BY LABEL','wceue') ?>" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>01-icon.png" alt="icon 01"/>
                    <h2><?php _e('FILTER BY LABEL','wceue');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__('%1$sEase the research of products%2$s on your shop offering your users the complete list of the products of the same energetic class in a single screen. One click on the label, and that\'s all.', 'wceue'), '<b>', '</b>');?>
                </p>
            </div>
        </div>
    </div>
    <div class="two section section-odd clear">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>02-icon.png" alt="icon 02" />
                    <h2><?php _e('REDIRECTION TO A SPECIFIC URL','wceue');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__(' Take advantage of this feature if you want %1$sto address your users%2$s to a certain page once clicking on any energetic class label of your products. A useful strategy to shift your customer\'s attention to an informative content, or a particular deal. ', 'wceue'), '<b>', '</b>');?>
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>02.png" alt="<?php _e( 'REDIRECTION TO A URL','wceue') ?>" />
            </div>
        </div>
    </div>
    <div class="three section section-even clear">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>03.png" alt="<?php _e( 'ADD A TOOLTIP','wceue') ?>" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_WCEUE_ASSETS_URL . '/images/' ?>03-icon.png" alt="icon 03" />
                    <h2><?php _e( 'ADD A TOOLTIP','wceue');?></h2>
                </div>
                <p>
                    <?php echo sprintf(__('%1$sThumbnail space is not enough to add all the technical features of your products?%2$s Use a tooltip to solve this issue. With it, you can add an image that will be displayed when the mouse will be over the product label, in order to make the research of your shop fluid and pleasant. ', 'wceue'), '<b>', '</b>');?>
                </p>
            </div>
        </div>
    </div>
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    <?php echo sprintf( __('Upgrade to %1$spremium version%2$s of %1$sYITH WooCommerce Uploads%2$s to benefit from all features!','wceue'),'<span class="highlight">','</span>' );?>
                </p>
                <a href="<?php echo $this->get_premium_landing_uri() ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight"><?php _e('UPGRADE','wceue');?></span>
                    <span><?php _e('to the premium version','wceue');?></span>
                </a>
            </div>
        </div>
    </div>
</div>
