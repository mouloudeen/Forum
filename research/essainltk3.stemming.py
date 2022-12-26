import nltk
from nltk.stem import PorterStemmer
from nltk.stem.snowball import FrenchStemmer
from nltk.tokenize import word_tokenize
##pour trouver la racine de chaque mot, ça fonctionne mieux en anglais qu'en français.
fs = FrenchStemmer()
ps = PorterStemmer()

exemple_mots = ["jouabilité","joué","mangeoire","jeux"]
example_words = ["python","pythoner","pythoning","pythoned","pythonly"]

for w in exemple_mots:
    print(fs.stem(w))

for w in example_words:
    print(ps.stem(w))    
    
