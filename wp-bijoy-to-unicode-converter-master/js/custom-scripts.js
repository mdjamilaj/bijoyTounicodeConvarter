function convert_text(){

		var t="bangla";
		
		var w = document.getElementById('title').value;
        var content1=document.getElementById('content').value;
        w = cM(t,w);
        content1 = cM(t,content1);

        document.getElementById('content').value='';
       	document.getElementById('title').value=w;
		ag(document.getElementById('content'),content1);

}
