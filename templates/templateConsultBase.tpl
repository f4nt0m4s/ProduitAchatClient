{% extends "templateBase2.tpl" %}

{% block navigation %}

<div class="menu">
	<h2> Consultation </h2>
	<ul>
		<li><a href="consultProduits.php"> 	Produit 	</a></li>
		<li><a href="consultAchats.php"> 	Achat 		</a></li>
		<li><a href="consultClients.php">	Client 		</a></li>
	</ul>
	<h2> Modification </h2>
	<ul>
		<li><a href="modifProduits.php"> 	Produit 	</a></li>
		<li><a href="modifAchats.php"> 	Achat 		</a></li>
		<li><a href="modifClients.php">	Client 		</a></li>
	</ul>
</div>

{% endblock %}


{% block contenu %}

	{% if msg is defined %}
	<h2> {{ msg 	}} 		</h2>
	{% endif %}

	{% if erreur is defined %}
	<h4> {{ erreur 	}} 		</h4>
	{% endif %}
	
	<p>
		<table>
			{# Le nom de chaque colonnes #}
			<thead>
				<tr>
					
					{% for col in nomTuples %}
					<th> <a href="{{ nomScript }}?choix={{ col }}"> {{ col }} </a></th>
					{% endfor %}
				</tr>
			</thead>
			
			{# Le contenu de chaque colonnes #}
			<tbody>

			{% for item in items %}
	
				{% if params is defined %}

					{% for param in params %}

							{# item etant un objet de type Client #}

							{% if item.getIdcli() == param or item.getNp() == param %}
									<tr class="vert">
							{% else %}
									<tr>
							{% endif %}

					{% endfor %}
				
				{% endif %}

										{% block lignetab %}
										{% endblock %}

									</tr>
			{% endfor %}
			
			</tbody>
		</table>
	</p>

{% block retourAccueil %}
	<ul>
		<li><a href="deconnexion.php">Se déconnecter</a>
	</ul>
{% endblock %}	

{% endblock %}