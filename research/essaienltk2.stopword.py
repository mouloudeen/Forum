import nltk
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
exemple_texte = """Nous avons tenu compte du fait que les lecteurs de ce livre n’ont pas eu, dans leur grande majorité, la possibilité de se familiariser avec l’histoire de la civilisation arabo-musulmane
, encore moins avec l’histoire de ses sciences, et, d’une manière plus générale, avec les activités intellectuelles qui y ont été pratiquées durant des siècles. La situation s’est relativement améliorée
depuis l’introduction, il y a quelques années, dans les programmes et dans les manuels scolaires, d’un certain nombre de chapitres sur l’Islam et sa civilisation. Mais, à notre avis, cela reste en deça
̀ de ce que l’on devrait connaître en France et en Europe sur le sujet. Aussi avons-nous jugé utile de consacrer le premier chapitre de ce livre à certains aspects liés aux contextes géographiques,
sociaux, culturels, politiques et économiques dans lesquels sont nées et se sont développées les sciences arabes, du IXe au XVe siècle."""
stop_worde = set(stopwords.words("english"))
stop_wordf = set(stopwords.words("french"))
##print(stop_worde) 
##print(stop_wordf)
##words = word_tokenize(exemple_texte)
##phrase_filtre = []
##for w in words:
##	if w not in stop_wordf:
##		phrase_filtre.append(w)
##print(phrase_filtre)
##phrase_filtre = [w for w in words if not w in stop_wordf]
##print(phrase_filtre)
print(stopwords.words("french"))

