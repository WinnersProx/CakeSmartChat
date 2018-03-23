
	<!-- The value of the title get changed-->
	<?= $this->assign('title', 'Cake-Projects:'.$this->request->controller);?>

	<!-- The value of the title get changed-->
	<!--To load the stylesheet page particularly for the current page-->
	<?= $this->Html->css('main',['block'=> true]);?>	
	<!--To load the stylesheet page particularly for the current page-->
	<table class="table table-bordered table-striped">
		<thead>
			<th>
				<span>Author</span> |
			</th>
			<th>
				Topic |
			</th>
			<th>
				Content |
			</th>
			<th>
				Action |
			</th>
		</thead>
		<tbody>
			<tr>
				<td>WinnersProx</td>
				<td>The Life In the Lord Christ!</td>
				<td>The first topic in French but english one are comming soon!</td>
				<td><button class="button small" style="border-radius: 15px;">Edit</button> | 
					<button class="button small" style="border-radius: 15px;">Comment</button></td>
			</tr>
			<tr>
				<td>Patrick</td>
				<td>The Life in Spiritual way!</td>
				<td>The second topic in French but english one are comming soon!</td>
				<td><button class="button small" style="border-radius: 15px;">Edit</button> | 
					<button class="button small" style="border-radius: 15px;">Comment</button>
				</td>
			</tr>

			
		</tbody>
		
	</table>
	<div id="buttom-btn">
		<button class="button right small" style="border-radius: 15px;"><i class="bullet cutlery"><a href="lists/catname/La vie" style="color: white;">Add Others!</i></a></button>

	</div>


	<!--Salut <?= $nom;?>-->