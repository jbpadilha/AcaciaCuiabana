<?php 
session_start();
header("Content-Type: text/html; charset=UTF-8",true); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
		<title>AGGEMT - ASSOCIAÇÃO DE GESTORES GOVERNAMENTAIS DO ESTADO DE MATO GROSSO</title>
		<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" href="../style.ie6.css" type="text/css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" href="../style.ie7.css" type="text/css" media="screen" /><![endif]-->
		<script type="text/javascript" src="../jquery.js"></script>
		<script type="text/javascript" src="../script.js"></script>
	</head>
	<body>
		<div id="art-main">
			<div class="art-header">
				<div class="art-header-center">
					<div class="art-header-png"></div>
					<div class="art-header-jpeg"></div>
				</div>
				<div class="art-header-wrapper">
					<div class="art-header-inner">
						<div class="art-logo">
							<h1 id="name-text" class="art-logo-name">AGGE - MT</h1>
							<h2 id="slogan-text" class="art-logo-text">Associação de Gestores Governamentais do estado de Mato Grosso</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="art-sheet">
				<div class="art-sheet-tl"></div>
				<div class="art-sheet-tr"></div>
				<div class="art-sheet-bl"></div>
				<div class="art-sheet-br"></div>
				<div class="art-sheet-tc"></div>
				<div class="art-sheet-bc"></div>
				<div class="art-sheet-cl"></div>
				<div class="art-sheet-cr"></div>
				<div class="art-sheet-cc"></div>
				<div class="art-sheet-body">
					<div class="art-content-layout">
						<div class="art-content-layout-row">
							<div class="art-layout-cell art-content">
								<div class="art-post">
									<div class="art-post-body">
										<div class="art-post-inner art-article">
											<div class="art-postmetadataheader">
												<h2 class="art-postheader"><img src="../images/postheadericon.png" width="19" height="17" alt="" />Administração - Sistema AGGE-MT</h2>
											</div>
											<div class="art-postcontent">
												<p>Entre com seu usuário e senha.</p>
												<form name="form" action="../../application/recebePostGet.php" method="post">
												<input type="hidden" id="control" name="control" value="Login"/>
												<table>
													<tr>
														<td>Usuário:</td>
														<td colspan="2" align="left"><input type="text" name="usuario" id="usuario" style="text-transform: lowercase;" /></td>
													</tr>
													<tr>
														<td>Senha:</td>
														<td><input type="password" name="senha" id="senha" /></td>
														<td><input type="submit" name="submit" id="submit" value="Logar"/></td>
													</tr>
												</table>
												</form>
											</div>
											<div class="cleared"></div>
										</div>
										<div class="cleared"></div>
									</div>
								</div>
								<div class="cleared"></div>
							</div>
						</div>
					</div>
					<div class="cleared"></div>
					<div class="art-footer">
						<div class="art-footer-t"></div>
						<div class="art-footer-l"></div>
						<div class="art-footer-b"></div>
						<div class="art-footer-r"></div>
						<div class="art-footer-body">
							<div class="art-footer-text">
								<p>Copyright © 2011. All Rights Reserved.</p>
							</div>
							<div class="cleared"></div>
						</div>
					</div>
					<div class="cleared"></div>
				</div>
			</div>
			<div class="cleared"></div>
			<p class="art-page-footer">Powered by <a href="http://www.joaopadilha.com/">JPadilha</a></p>
		</div>
	</body>
</html>
