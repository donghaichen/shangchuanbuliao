<div class="entry" itemprop="articleBody"><p>倡萌的主题预留了timthumb截图功能，所以在这里简单说说 使用timthumb实现WordPress缩略图截取。</p><p>什么是 timthumb.php 呢？这是一个专门为 WordPress 而开发的缩略图应用的项目。有点类似于插件，但是又和 WordPress 插件不同，因为它不是被上传于 plugins 文件夹下，而是需要上传到你的主题文件夹中。你可以在这里<a href="http://code.google.com/p/timthumb/" target="_blank">了解和下载最新版本的 timthumb.php</a>，一般默认配置也就可以了。倡萌这里只是简单说说使用，更过的介绍就靠大家自己去搜索了。</p><h3>timthumb使用方法</h3><p>要使用timthumb，需要主机支持GD库，现在一般的收费主机都是支持的。下载并将其上传到你的空间，然后在和timthumb.php同一个目录下，新建一个cache文件夹，linux主机用户，要设置cache文件夹为 755 或 777 权限。</p><p>使用的时候，一般图片的地址是这样的：</p><div class="wp_syntax"><table><tbody><tr><td class="line_numbers"><pre>1
</pre></td><td class="code"><pre class="html4strict" style="font-family:monospace;"><span style="color: #009900;">&lt;<span style="color: #000000; font-weight: bold;">img</span> <span style="color: #000066;">src</span><span style="color: #66cc66;">=</span><span style="color: #ff0000;">"http://timthumb所在目录/timthumb.php?src=图片地址&amp;h=图片高度&amp;w=图片宽度&amp;zc=1"</span> <span style="color: #000066;">class</span><span style="color: #66cc66;">=</span><span style="color: #ff0000;">"thumb"</span> <span style="color: #66cc66;">/</span>&gt;</span></pre></td></tr></tbody></table></div><p>其中,h为缩略图的高度，w为缩略图宽度，zc有两个属性值，1表示裁剪，0表示按设置的高宽压缩，不裁剪。</p><p>关于timthumb的使用和设置，大家自己google搜索吧。</p><p>下面是倡萌在主题中使用的timthumb的代码：</p><p>首先，在functions.php中添加下面的代码，来获取图片的地址：</p><div class="wp_syntax"><table><tbody><tr class="alt"><td class="line_numbers"><pre>1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
</pre></td><td class="code"><pre class="php" style="font-family:monospace;"><span style="color: #666666; font-style: italic;">//添加特色缩略图支持</span>
<span style="color: #b1b100;">if</span> <span style="color: #009900;">(</span> <span style="color: #990000;">function_exists</span><span style="color: #009900;">(</span><span style="color: #0000ff;">'add_theme_support'</span><span style="color: #009900;">)</span> <span style="color: #009900;">)</span>add_theme_support<span style="color: #009900;">(</span><span style="color: #0000ff;">'post-thumbnails'</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
&nbsp;
<span style="color: #666666; font-style: italic;">//输出缩略图地址 From wpdaxue.com</span>
<span style="color: #000000; font-weight: bold;">function</span> post_thumbnail_src<span style="color: #009900;">(</span><span style="color: #009900;">)</span><span style="color: #009900;">{</span>
    <span style="color: #000000; font-weight: bold;">global</span> <span style="color: #000088;">$post</span><span style="color: #339933;">;</span>
	<span style="color: #b1b100;">if</span><span style="color: #009900;">(</span> <span style="color: #000088;">$values</span> <span style="color: #339933;">=</span> get_post_custom_values<span style="color: #009900;">(</span><span style="color: #0000ff;">"thumb"</span><span style="color: #009900;">)</span> <span style="color: #009900;">)</span> <span style="color: #009900;">{</span>	<span style="color: #666666; font-style: italic;">//输出自定义域图片地址</span>
		<span style="color: #000088;">$values</span> <span style="color: #339933;">=</span> get_post_custom_values<span style="color: #009900;">(</span><span style="color: #0000ff;">"thumb"</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
		<span style="color: #000088;">$post_thumbnail_src</span> <span style="color: #339933;">=</span> <span style="color: #000088;">$values</span> <span style="color: #009900;">[</span><span style="color: #cc66cc;">0</span><span style="color: #009900;">]</span><span style="color: #339933;">;</span>
	<span style="color: #009900;">}</span> <span style="color: #b1b100;">elseif</span><span style="color: #009900;">(</span> has_post_thumbnail<span style="color: #009900;">(</span><span style="color: #009900;">)</span> <span style="color: #009900;">)</span><span style="color: #009900;">{</span>    <span style="color: #666666; font-style: italic;">//如果有特色缩略图，则输出缩略图地址</span>
        <span style="color: #000088;">$thumbnail_src</span> <span style="color: #339933;">=</span> wp_get_attachment_image_src<span style="color: #009900;">(</span>get_post_thumbnail_id<span style="color: #009900;">(</span><span style="color: #000088;">$post</span><span style="color: #339933;">-&gt;</span><span style="color: #004000;">ID</span><span style="color: #009900;">)</span><span style="color: #339933;">,</span><span style="color: #0000ff;">'full'</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
		<span style="color: #000088;">$post_thumbnail_src</span> <span style="color: #339933;">=</span> <span style="color: #000088;">$thumbnail_src</span> <span style="color: #009900;">[</span><span style="color: #cc66cc;">0</span><span style="color: #009900;">]</span><span style="color: #339933;">;</span>
    <span style="color: #009900;">}</span> <span style="color: #b1b100;">else</span> <span style="color: #009900;">{</span>
		<span style="color: #000088;">$post_thumbnail_src</span> <span style="color: #339933;">=</span> <span style="color: #0000ff;">''</span><span style="color: #339933;">;</span>
		<span style="color: #990000;">ob_start</span><span style="color: #009900;">(</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
		<span style="color: #990000;">ob_end_clean</span><span style="color: #009900;">(</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
		<span style="color: #000088;">$output</span> <span style="color: #339933;">=</span> <span style="color: #990000;">preg_match_all</span><span style="color: #009900;">(</span><span style="color: #0000ff;">'/&lt;img.+src=[\'"]([^\'"]+)[\'"].*&gt;/i'</span><span style="color: #339933;">,</span> <span style="color: #000088;">$post</span><span style="color: #339933;">-&gt;</span><span style="color: #004000;">post_content</span><span style="color: #339933;">,</span> <span style="color: #000088;">$matches</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
		<span style="color: #000088;">$post_thumbnail_src</span> <span style="color: #339933;">=</span> <span style="color: #000088;">$matches</span> <span style="color: #009900;">[</span><span style="color: #cc66cc;">1</span><span style="color: #009900;">]</span> <span style="color: #009900;">[</span><span style="color: #cc66cc;">0</span><span style="color: #009900;">]</span><span style="color: #339933;">;</span>   <span style="color: #666666; font-style: italic;">//获取该图片 src</span>
		<span style="color: #b1b100;">if</span><span style="color: #009900;">(</span><span style="color: #990000;">empty</span><span style="color: #009900;">(</span><span style="color: #000088;">$post_thumbnail_src</span><span style="color: #009900;">)</span><span style="color: #009900;">)</span><span style="color: #009900;">{</span>	<span style="color: #666666; font-style: italic;">//如果日志中没有图片，则显示随机图片</span>
			<span style="color: #000088;">$random</span> <span style="color: #339933;">=</span> <span style="color: #990000;">mt_rand</span><span style="color: #009900;">(</span><span style="color: #cc66cc;">1</span><span style="color: #339933;">,</span> <span style="color: #cc66cc;">10</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
			<span style="color: #b1b100;">echo</span> get_bloginfo<span style="color: #009900;">(</span><span style="color: #0000ff;">'template_url'</span><span style="color: #009900;">)</span><span style="color: #339933;">;</span>
			<span style="color: #b1b100;">echo</span> <span style="color: #0000ff;">'/images/pic/'</span><span style="color: #339933;">.</span><span style="color: #000088;">$random</span><span style="color: #339933;">.</span><span style="color: #0000ff;">'.jpg'</span><span style="color: #339933;">;</span>
			<span style="color: #666666; font-style: italic;">//如果日志中没有图片，则显示默认图片</span>
			<span style="color: #666666; font-style: italic;">//echo '/images/default_thumb.jpg';</span>
		<span style="color: #009900;">}</span>
	<span style="color: #009900;">}</span><span style="color: #339933;">;</span>
	<span style="color: #b1b100;">echo</span> <span style="color: #000088;">$post_thumbnail_src</span><span style="color: #339933;">;</span>
<span style="color: #009900;">}</span></pre></td></tr></tbody></table></div><p>上面的代码获取图片的顺序是：自定义域 thumb 的图片 &gt; wordpress特色图片 &gt; 文章第一张图片 &gt; 随机图片/默认图片</p><p>然后在调用缩略图的地方使用类似的代码：</p><div class="wp_syntax"><table><tbody><tr><td class="line_numbers"><pre>1
</pre></td><td class="code"><pre class="html4strict" style="font-family:monospace;"><span style="color: #009900;">&lt;<span style="color: #000000; font-weight: bold;">img</span> <span style="color: #000066;">src</span><span style="color: #66cc66;">=</span><span style="color: #ff0000;">"http://timthumb所在目录/timthumb.php?src=&lt;?php echo post_thumbnail_src(); ?&gt;</span></span><span style="color: #ddbb00;">&amp;h=150&amp;w=2000&amp;zc=1" alt="&lt;?php the_title();</span> ?&gt;" class="thumbnail"/&gt;</pre></td></tr></tbody></table></div><p>就可以显示缩略图。你可以修改上面的参数，实现不同位置显示不同大小的缩略图。</p><blockquote><p>注：上面的代码只是一个例子，请根据你的需要自己修改，如果你不会代码，就不要使用我的代码了，没时间多说。</p></blockquote><blockquote><p>倡萌的主题中，timthumb功能是预留的，你可以在主题设置中，根据自己的需要设置启用或禁用，不需要你修改任何文件。</p></blockquote><h3>timthumb常见问答</h3><p><strong>1.WordPress本身就有截取缩略图的功能，为什么要使用timthumb呢？</strong></p><p>WordPress本身的缩略图截取功能，会对上传的任何图片都进行裁剪，每个图片都删除缩略图保存在空间中，特点是，图片只生成一次，需要调用是不会再次生成，但是有很多缩略图根本用不到，占用空间。</p><p>timthumb只对要作为缩略图的那个图片进行裁剪，并且是在有访问请求时才临时处理生成，生成的是一个配置文件，不存在真正的缩略图文件，在一定的时间内会缓存在空间中，失效后，有访问请求会重新生成。特点是，不会生成多余的缩略图，但是处理过程需要一定的服务器资源支持。</p><p><strong>2.听说timthumb以前有漏洞，现在不放心？</strong></p><p>任何程序都会存在漏洞，包括WordPress本身，timthumb之前也一样，但是最新版本已经算是比较安全了，我只能说，如果你担心，那就不要用。</p><div class="clear"></div><div class="clear"></div></div>
