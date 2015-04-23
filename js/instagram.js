// JavaScript Document
	
						
$(function() {
	
	var apiurl = "https://api.instagram.com/v1/tags/cloneclub/media/recent?access_token=16296234.063db2b.d5e064ea4f4a4f66b51737746c31922a&callback=?"
	var access_token = location.hash.split('=')[1];
	var html = ""
	
		$.ajax({
			type: "GET",
			dataType: "json",
			cache: false,
			url: apiurl,
			success: parseData
		});
				
		
		function parseData(json){
			console.log(json);
			
			$.each(json.data,function(i,data){
				
				html += '<a href="' + data.link + '" target="_blank" title="' + data.caption.text + '"><img src ="' + data.images.thumbnail.url + '"> </a>'
				// html += '<a href="' + data.link + '"><img src ="' + data.images.thumbnail.url + '"> </a>'
				// html += '<img src ="' + data.images.thumbnail.url + '">';
				// html += 'Text:"' + data.caption.text + '">';
				
				
			});
			
			console.log(html);
			$("#results").append(html);
			
		}
		
		
                
               
 });
		
		
		
		
	

		
