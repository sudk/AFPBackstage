<?php

class WechatTpl {

    public static function TextTpl() {

        $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
        return $textTpl;
    }

    public static function OneNewsTpl(){
        $tpl="<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>1</ArticleCount>
<Articles>
<item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
</Articles>
</xml>";
        return $tpl;
    }

    public static function Menu(){
        return <<<EOF
{
     "button":[
          {
               "name":"发现",
               "sub_button":[
                    {
                       "type":"click",
                       "name":"优惠券",
                       "key":"coupon"
                    },
                    {
                       "type":"click",
                       "name":"促销活动",
                       "key":"activities"
                    },
                    {
                       "type":"click",
                       "name":"商户",
                       "key":"merchant"
                    }
                ]
           },
           {
               "name":"自助服务",
               "sub_button":[
                    {
                       "type":"click",
                       "name":"加入会员",
                       "key":"vipcard"
                    },
                    {
                       "type":"click",
                       "name":"绑定银行卡",
                       "key":"bandcard"
                    },
                    {
                       "type":"click",
                       "name":"联系我们",
                       "key":"contact"
                    }
                ]
           },
           {
               "name":"会员中心",
               "sub_button":[
                    {
                       "type":"click",
                       "name":"我的收藏",
                       "key":"my_favorite"
                    },
                    {
                       "type":"click",
                       "name":"我的资产",
                       "key":"my_source"
                    },
                    {
                       "type":"click",
                       "name":"我的会员卡",
                       "key":"my_card"
                    },
                    {
                       "type":"click",
                       "name":"我的积分",
                       "key":"my_points"
                    }
                ]
           }
       ]
 }
EOF;

    }

}