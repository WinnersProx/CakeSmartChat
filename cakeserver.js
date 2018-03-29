let http = require("http")
let url = require("url")
let fs = require("fs")

http.createServer(($req, $res) => {
	let $page = $req.url;
	$res.writeHead(200,{
		'Content-type' : 'text/html;charset=utf-8'
	})
	console.log($page);
	if($page === '/login'){
		fs.readFile('src/Template/Users/login.ctp', ($err, $data) => {
			if($err) throw $err
			$res.end($data)
		})

	}
	else{
		$res.end("Ended successfully");
	}


}).listen(8025);