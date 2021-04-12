{% extends "templateBase2.tpl" %}

{% block contenu %}
	
			<h2 style="margin-left:5%;"> {{ message }} </h2>

			<table style="margin-left:8%;">
				<form action="gestionConnexion.php" method="post"> 
				
					<tr>
						<td> 
							<label for="login">identifiant</label>
						</td>
						<td> 
							<input type="text" name="login" value="{{ identifiant }}" required>
							
							{% if tabErreurs['login'] is defined %}
								{% if tabErreurs['login'] is not empty %}
									<span style="color: red;"> {{ tabErreurs['login'] }} </span>
								{% endif %}
							{% endif %}

						</td>
					</tr>
					
					<tr>
						<td> 
							<label for="password">mot de passe</label>
						</td>
						<td> 
							<input type="password" name="password" required>

							{% if tabErreurs['password'] is defined %}
								{% if tabErreurs['password'] is not empty %}
									<span style="color: red; "> {{ tabErreurs['password'] }} </span>
								{% endif %}
							{% endif %}

						</td>
					</tr>
					
					<tr>
						<td>
							<input type="reset" name="annulation" value="Annuler">
						</td>
						<td>
							<input type="submit" name="envoi" value="Envoyer"> 
						</td>
					</tr>
				</form>
			</table>

{% endblock %}