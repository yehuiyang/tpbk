<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function tagNameToId($tags){
	$tags = explode(',', $tags);
	$tagids = array();
	foreach ($tags as $k => $v) {
		if (model('tag')->where('tagname',$v)->value('tid')=='') {
			$tagdata = ['tagname' => $v, 'gid' => ''];
			model('tag')->save($tagdata);
		}
		$tagids[] = model('tag')->where('tagname',$v)->value('tid');
	}
	return implode(',', $tagids);
}
function addBlogIdToTag($blogid,$tagids){
	$tags = explode(',', $tagids);
	foreach ($tags as $k => $v) {
		$blogs = model('tag')->where('tid',$v)->value('gid');
		if (strpos($blogs,$blogid)===false) {
			$blogs .= ','.$blogid;
			model('tag')->where('tid',$v)->update(['gid'=>trim($blogs)]);
		}
	}
}