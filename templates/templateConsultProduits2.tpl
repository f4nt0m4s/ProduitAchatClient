{% extends "templateConsultBase.tpl" %}

{% block lignetab %}
	<td> <a href="consultAchats.php?np={{ item.getNp() }}"> {{ item.getNp() 	}} </a></td>
	<td> {{ item.getLib() 	}} 	</td>
	<td> {{ item.getCoul() 	}} 	</td>
	<td> {{ item.getQs() 	}} 	</td>
{% endblock %}