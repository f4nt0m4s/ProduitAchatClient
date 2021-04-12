{% extends "templateConsultBase.tpl" %}

{% block lignetab %}
						<td> <a href="consultClients.php?ncli={{ item.getNcli() }}"> {{ item.getNcli() 	}} 	</a></td>
						<td> <a href="consultProduits.php?np={{ item.getNp() }}"> {{ item.getNp() 	}} 	</a></td>
						<td> {{ item.getQa() 	}} 	</td>
{% endblock %}