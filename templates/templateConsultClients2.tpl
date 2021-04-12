{% extends "templateConsultBase.tpl" %}

{% block lignetab %}
	<td> <a href="consultAchats.php?ncli={{ item.getIdcli() }}"> {{ item.getIdcli() 	}} 	</a></td>
	<td> {{ item.getNom() 		}} 	</td>
	<td> {{ item.getVille() 	}} 	</td>
{% endblock %}