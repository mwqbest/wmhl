layui.config({
	base : "js/"
}).use(['form','layer','jquery','layedit','laydate','upload'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		upload = layui.upload,
		$ = layui.jquery;

	//创建一个编辑器
 	var editIndex = layedit.build('news_content');

 	//执行实例
	var uploadInst = upload.render({
		elem: '#img_upload' //绑定元素
		,url: '/admin.php/Public/upload.html' //上传接口
		,data: {type:2}
		,done: function(res){
		      //上传完毕回调
		      if(res.code==128){
		      	layer.msg('上传成功', {
						icon: 1,
						time: 1000 //2秒关闭（如果不配置，默认是3秒）
						}, function(){
						$('#news_img').val(res.data);
					});
		      }
		},error: function(){
		      //请求异常回调
		}
	});
 	var addNewsArray = [],addNews;

 	form.on("submit(addNews)",function(data){
 		var content = layedit.getContent(editIndex);
	 	//显示、审核状态
 		var is_hot = data.field.is_hot=="on" ? 1 : 0,
 			status = data.field.status=="on" ? 1 : 0;
 		var push ={
 			title:$("#title").val(),
 			author:$("#author").val(),
 			add_time:$("#add_time").val(),
 			view:$("#view").val(),
 			sort:$("#sort").val(),
 			img:$("#news_img").val(),
 			seo_key:$("#seo_key").val(),
 			abstract:$("#abstract").val(),
 			content:content,
 			id:$("#id").val(),
 			cate_id:$("#cate_id").val(),
 			is_hot:is_hot,
 			status:status
 		};
 		//弹出loading
 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
 		$.ajax({
			url  : '/admin.php/News/ajaxAddNews.html',
			type : "post",
			dataType :"json",
			data:push,
			success : function(data){
				if (data.code == '128') {
	                setTimeout(function(){
			            top.layer.close(index);
						top.layer.msg(data.msg);
			 			layer.closeAll("iframe");
				 		//刷新父页面
				 		parent.location.reload();
			        },2000);
	            } else if(data.code == '129'){
	            	top.layer.close(index);
	            	top.layer.msg(data.msg);
	            	return false;
	            }
			}
		});
 		return false;
 	})
	
})
