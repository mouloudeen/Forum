Python 3.7.2 (v3.7.2:9a3ffc0492, Dec 24 2018, 02:44:43) 
[Clang 6.0 (clang-600.0.57)] on darwin
Type "help", "copyright", "credits" or "license()" for more information.
>>> 
import nltk
>>> exemple_phrase = "Il n ’y a pas de divergence, parmi les gens sages et informés, sur le fait que les sciences, dans leur totalité, sont apparues selon la règle de l’accroissement et de la ramification et qu’elles ne sont pas limitées par une fin qui ne supposerait pas le dépassement."
>>> from nltk.tokenize import sent_tokenize, word_tokenize
>>> print(sent_tokenize(exemple_phrase))
['Il n ’y a pas de divergence, parmi les gens sages et informés, sur le fait que les sciences, dans leur totalité, sont apparues selon la règle de l’accroissement et de la ramification et qu’elles ne sont pas limitées par une fin qui ne supposerait pas le dépassement.']
>>> print(word_tokenize(exemple_phrase))
['Il', 'n', '’', 'y', 'a', 'pas', 'de', 'divergence', ',', 'parmi', 'les', 'gens', 'sages', 'et', 'informés', ',', 'sur', 'le', 'fait', 'que', 'les', 'sciences', ',', 'dans', 'leur', 'totalité', ',', 'sont', 'apparues', 'selon', 'la', 'règle', 'de', 'l', '’', 'accroissement', 'et', 'de', 'la', 'ramification', 'et', 'qu', '’', 'elles', 'ne', 'sont', 'pas', 'limitées', 'par', 'une', 'fin', 'qui', 'ne', 'supposerait', 'pas', 'le', 'dépassement', '.']
>>> for i in word_tokenize(exemple_phrase):
	print(i)

	
Il
n
’
y
a
pas
de
divergence
,
parmi
les
gens
sages
et
informés
,
sur
le
fait
que
les
sciences
,
dans
leur
totalité
,
sont
apparues
selon
la
règle
de
l
’
accroissement
et
de
la
ramification
et
qu
’
elles
ne
sont
pas
limitées
par
une
fin
qui
ne
supposerait
pas
le
dépassement
.
>>> 
