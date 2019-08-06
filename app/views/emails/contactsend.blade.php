<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>User Send Message</h2>
		<p>Welcome</p>
			<table>
					<tbody>
						<tr>
							<td>Full Name: </td>
							<td><?php echo $inputName?></td>
						</tr>
						<tr>
							<td>Email: </td>
							<td><?php echo $inputEmail;?></td>
						</tr>
						<tr>
							<td>Subject: </td>
							<td><?php echo $inputSubject;?></td>
						</tr>
						<tr>
							<td>Contact Content: </td>
							<td><?php echo $inputMessage;?></td>
						</tr>
					</tbody>
			</table>
	</body>
</html>
