<?php

/**
 * AjaxLinkPager displays a list of hyperlinks that lead to different pages of target.
 *
 * @author Su Dunkuai <sudk@trunkbow.com>
 * @since 1.0
 */
class MainMenu extends Cwidget
{

    /**
     * Initializes the pager by setting some default property values.
     */
    public function init()
    {

    }
    public function menuData(){
        return array(
            '发现'=>array(
                '优惠券'=>array('init_url'=>'./?r=coupon/coupon/branch'),
                '优惠券'=>array('init_url'=>'./?r=coupon/coupon/branch'),
                '优惠券'=>array('init_url'=>'./?r=coupon/coupon/branch'),
                '优惠券'=>array('init_url'=>'./?r=coupon/coupon/branch'),
            ),
        );
    }
}
