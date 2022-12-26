# -*- coding: utf-8 -*-

# # 2A.eco - Traitement automatique de la langue en Python - correction
# 
# Correction d'exercices liés au traitement automatique du langage naturel.

# In[1]:


from jyquickhelper import add_notebook_menu
add_notebook_menu()


# On télécharge les données textuelles nécessaires pour le package [nltk](http://www.nltk.org/data.html).

# In[2]:


import nltk
nltk.download('stopwords')


# ## Exercice 1

# In[3]:


corpus = { 
 'a' : "Mr. Green killed Colonel Mustard in the study with the candlestick. \
Mr. Green is not a very nice fellow.",
 'b' : "Professor Plum has a green plant in his study.",
 'c' : "Miss Scarlett watered Professor Plum's green plant while he was away \
from his office last week."
}
terms = {
 'a' : [ i.lower() for i in corpus['a'].split() ],
 'b' : [ i.lower() for i in corpus['b'].split() ],
 'c' : [ i.lower() for i in corpus['c'].split() ]
 }

from math import log

QUERY_TERMS = ['green', 'plant']

def tf(term, doc, normalize=True):
    doc = doc.lower().split()
    if normalize:
        return doc.count(term.lower()) / float(len(doc))
    else:
        return doc.count(term.lower()) / 1.0


def idf(term, corpus):
    num_texts_with_term = len([True for text in corpus if term.lower()
                              in text.lower().split()])
    try:
        return 1.0 + log(float(len(corpus)) / num_texts_with_term)
    except ZeroDivisionError:
        return 1.0
    
def tf_idf(term, doc, corpus):
    return tf(term, doc) * idf(term, corpus)


query_scores = {'a': 0, 'b': 0, 'c': 0}
for term in [t.lower() for t in QUERY_TERMS]:
    for doc in sorted(corpus):
        score = tf_idf(term, corpus[doc], corpus.values())
        query_scores[doc] += score

print("Score TF-IDF total pour le terme '{}'".format(' '.join(QUERY_TERMS), ))
for (doc, score) in sorted(query_scores.items()):
    print(doc, score)


# Deux documents possibles : b ou c (a ne contient pas le mot "plant"). B est plus court : donc *green plant* "pèse" plus.

# In[4]:


QUERY_TERMS = ['plant', 'green']

query_scores = {'a': 0, 'b': 0, 'c': 0}
for term in [t.lower() for t in QUERY_TERMS]:
    for doc in sorted(corpus):
        score = tf_idf(term, corpus[doc], corpus.values())
        query_scores[doc] += score

print("Score TF-IDF total pour le terme '{}'".format(' '.join(QUERY_TERMS), ))
for (doc, score) in sorted(query_scores.items()):
    print(doc, score)


# Le score TF-IDF ne tient pas compte de l'ordre des mots. Approche "bag of words".

# In[5]:


QUERY_TERMS = ['green']
term = [t.lower() for t in QUERY_TERMS]


# In[6]:


term = 'green'

query_scores = {'a': 0, 'b': 0, 'c': 0}

for doc in sorted(corpus):
    score = tf_idf(term, corpus[doc], corpus.values())
    query_scores[doc] += score

print("Score TF-IDF total pour le terme '{}'".format(term))
for (doc, score) in sorted(query_scores.items()):
    print(doc, score)


# In[7]:


len(corpus['b'])/len(corpus['a'])


# Scores proches entre a et b. a contient deux fois 'green', mais b est plus de deux fois plus court, donc le score est plus élevé. Il existe [d'autres variantes de tf-idf](https://en.wikipedia.org/wiki/Tf%E2%80%93idf). Il faut choisir celui qui correspond le mieux à vos besoins.

# ## Exercice 2

# ### Elections américaines 

# In[8]:


import json
import nltk

USER_ID = '107033731246200681024'

with open('./ressources_googleplus/' + USER_ID + '.json', 'r') as f:
    activity_results=json.load(f)

all_content = " ".join([ a['object']['content'] for a in activity_results ])
tokens = all_content.split()
text = nltk.Text(tokens)


# In[9]:


text.concordance('Hillary')


# In[10]:


text.concordance('Trump')


# In[11]:


text.concordance('vote')


# In[12]:


text.concordance('politics')


# In[13]:


fdist = text.vocab()
fdist['Hillary'], fdist['Trump'], fdist['vote'], fdist['politics']


# ### Loi Zipf 

# In[14]:


get_ipython().run_line_magic('matplotlib', 'inline')


# In[15]:


fdist = text.vocab()

no_stopwords = [(k,v) for (k,v) in fdist.items() if k.lower()                          not in nltk.corpus.stopwords.words('english')]

#nltk a été porté en python récemment, quelques fonctionnalités se sont perdues 
#(par exemple, Freq Dist n'est pas toujours ordonné par ordre décroissant)
#fdist_no_stopwords = nltk.FreqDist(no_stopwords)
#fdist_no_stopwords.plot(100, cumulative = True)

#le plus rapide : passer par pandas
import pandas as p

df_nostopwords=p.Series(dict(no_stopwords))
df_nostopwords.sort_values(ascending=False)
df_nostopwords.plot()


# In[16]:


import matplotlib.pyplot as plt 

df_nostopwords=p.Series(dict(no_stopwords))
df_nostopwords.sort_values(ascending=False)
df_nostopwords=p.DataFrame(df_nostopwords)
df_nostopwords.rename(columns={0:'count'},inplace=True)
df_nostopwords['one']=1
df_nostopwords['rank']=df_nostopwords['one'].cumsum()
df_nostopwords['zipf_law']=df_nostopwords['count'].iloc[0]/df_nostopwords['rank']
df_nostopwords=df_nostopwords[1:]
plt.plot(df_nostopwords['count'],df_nostopwords['zipf_law'])
plt.plot(df_nostopwords['count'],df_nostopwords['count'])


# In[17]:


df = p.Series(fdist)
df.sort_values(ascending=False)
df.plot()


# In[18]:


df = p.Series(fdist)
df.sort_values(ascending=False)
df=p.DataFrame(df)
df.rename(columns={0:'count'},inplace=True)
df['one']=1
df['rank']=df['one'].cumsum()
df['zipf_law']=df['count'].iloc[0]/df['rank']
df=df[1:]
plt.plot(df['count'],df['zipf_law'])
plt.plot(df['count'],df['count']);


# ### Diversité du vocabulaire 

# In[19]:


def lexical_diversity(token_list):
    return len(token_list) / len(set(token_list))

USER_ID = '107033731246200681024'

with open('./ressources_googleplus/' + USER_ID + '.json', 'r') as f:
    activity_results=json.load(f)

all_content = " ".join([ a['object']['content'] for a in activity_results ])
tokens = all_content.split()
text = nltk.Text(tokens)

lexical_diversity(tokens)


# ## Exercice 3

# ### 3-1 Autres termes de recherche

# In[20]:


import json
import nltk


path = 'ressources_googleplus/107033731246200681024.json'
text_data = json.loads(open(path).read())

QUERY_TERMS = ['open','data']

activities = [activity['object']['content'].lower().split()               for activity in text_data                 if activity['object']['content'] != ""]

# Le package TextCollection contient un module tf-idf
tc = nltk.TextCollection(activities)

relevant_activities = []

for idx in range(len(activities)):
    score = 0
    for term in [t.lower() for t in QUERY_TERMS]:
        score += tc.tf_idf(term, activities[idx])
    if score > 0:
        relevant_activities.append({'score': score, 'title': text_data[idx]['title'],
                              'url': text_data[idx]['url']})

# Tri par score et présentation des résultats 

relevant_activities = sorted(relevant_activities, 
                             key=lambda p: p['score'], reverse=True)
c=0
for activity in relevant_activities:
    if c < 6:
        print(activity['title'])
        print('\tLink: {}'.format(activity['url']))
        print('\tScore: {}'.format(activity['score']))
        c+=1


# ### 3-2 Autres métriques de distance

# In[21]:


from math import log

def tf_binary(term, doc):
    doc_l = [d.lower() for d in doc]
    if term.lower() in doc:
        return 1.0
    else:
        return 0.0
    
def tf_rawfreq(term, doc):
    doc_l = [d.lower() for d in doc]
    return doc_l.count(term.lower())

def tf_lognorm(term,doc):
    doc_l = [d.lower() for d in doc]
    if doc_l.count(term.lower()) > 0:
        return 1.0 + log(doc_l.count(term.lower()))
    else:
        return 1.0

def idf(term,corpus):
    num_texts_with_term = len([True for text in corpus                               if term.lower() in text]) 
    try:
        return log(float(len(corpus) / num_texts_with_term))
    except ZeroDivisionError:
        return 1.0

def idf_init(term, corpus):
    num_texts_with_term = len([True for text in corpus                               if term.lower() in text])
    try:
        return 1.0 + log(float(len(corpus)) / num_texts_with_term)
    except ZeroDivisionError:
        return 1.0    
    
def idf_smooth(term,corpus):
    num_texts_with_term = len([True for text in corpus                               if term.lower() in text]) 
    try:
        return log(1.0 + float(len(corpus) / num_texts_with_term))
    except ZeroDivisionError:
        return 1.0
    
def tf_idf0(term, doc, corpus):
    return tf_binary(term, doc) * idf(term, corpus)

def tf_idf1(term, doc, corpus):
    return tf_rawfreq(term, doc) * idf(term, corpus)

def tf_idf2(term, doc, corpus):
    return tf_lognorm(term, doc) * idf(term, corpus)

def tf_idf3(term, doc, corpus):
    return tf_rawfreq(term, doc) * idf_init(term, corpus)

def tf_idf4(term, doc, corpus):
    return tf_lognorm(term, doc) * idf_init(term, corpus)

def tf_idf5(term, doc, corpus):
    return tf_rawfreq(term, doc) * idf_smooth(term, corpus)

def tf_idf6(term, doc, corpus):
    return tf_lognorm(term, doc) * idf_smooth(term, corpus)


# In[22]:


import json
import nltk


path = 'ressources_googleplus/107033731246200681024.json'
text_data = json.loads(open(path).read())

QUERY_TERMS = ['open','data']

activities = [activity['object']['content'].lower().split()               for activity in text_data                 if activity['object']['content'] != ""]

relevant_activities = []

   
for idx in range(len(activities)):
    score = 0
    for term in [t.lower() for t in QUERY_TERMS]:
        score += tf_idf1(term, activities[idx],activities)
    if score > 0:
        relevant_activities.append({'score': score, 'title': text_data[idx]['title'],
                              'url': text_data[idx]['url']})

# Tri par score et présentation des résultats 

relevant_activities = sorted(relevant_activities, 
                             key=lambda p: p['score'], reverse=True)
c=0
for activity in relevant_activities:
    if c < 6:
        print(activity['title'])
        print('\tLink: {}'.format(activity['url']))
        print('\tScore: {}'.format(activity['score']))
        c+=1


# Pensez-vous que pour notre cas la fonction tf_binary est justifiée ?

# ## Exercice 4

# In[23]:


import json
import nltk

path = 'ressources_googleplus/107033731246200681024.json'
data = json.loads(open(path).read())

# Sélection des textes qui ont plus de 1000 mots
data = [ post for post in json.loads(open(path).read())          if len(post['object']['content']) > 1000 ]

all_posts = [post['object']['content'].lower().split() 
             for post in data ]

tc = nltk.TextCollection(all_posts)

# Calcul d'une matrice terme de recherche x document
# Renvoie un score tf-idf pour le terme dans le document

td_matrix = {}
for idx in range(len(all_posts)):
    post = all_posts[idx]
    fdist = nltk.FreqDist(post)

    doc_title = data[idx]['title']
    url = data[idx]['url']
    td_matrix[(doc_title, url)] = {}

    for term in fdist.keys():
        td_matrix[(doc_title, url)][term] = tc.tf_idf(term, post)

distances = {}

for (title1, url1) in td_matrix.keys():
    
    distances[(title1, url1)] = {}
    (min_dist, most_similar) = (1.0, ('', ''))
    
    for (title2, url2) in td_matrix.keys():
        
        #copie des valeurs (un dictionnaire étant mutable)
        terms1 = td_matrix[(title1, url1)].copy()
        terms2 = td_matrix[(title2, url2)].copy()
        
        #on complete les gaps pour avoir des vecteurs de même longueur
        for term1 in terms1:
            if term1 not in terms2:
                terms2[term1] = 0

        for term2 in terms2:
            if term2 not in terms1:
                terms1[term2] = 0
                
        #on créé des vecteurs de score pour l'ensemble des terms de chaque document
        v1 = [score for (term, score) in sorted(terms1.items())]
        v2 = [score for (term, score) in sorted(terms2.items())]

        #calcul des similarité entre documents : distance cosine entre les deux vecteurs de scores tf-idf
        distances[(title1, url1)][(title2, url2)] =             nltk.cluster.util.cosine_distance(v1, v2)


# In[24]:


import pandas as p

df = p.DataFrame(distances)
df.index = df.index.droplevel(0)
df.iloc[:3,:3]


# In[25]:


knn_post7EaHeYc1BiB = df.loc['https://plus.google.com/+TimOReilly/posts/7EaHeYc1BiB']
knn_post7EaHeYc1BiB.sort_values()
#le post [0] est lui-même
knn_post7EaHeYc1BiB[1:6]


# ### Heatmap

# In[26]:


import pandas as p
import seaborn as sns; sns.set()
import matplotlib.pyplot as plt

fig = plt.figure( figsize=(8,8) )

ax = fig.add_subplot(111)

df = p.DataFrame(distances)

for i in range(len(df)):
    df.iloc[i,i]=0

pal = sns.light_palette((210, 90, 60), input="husl",as_cmap=True)
g = sns.heatmap(df, yticklabels = True, xticklabels = True, cbar=False, cmap=pal)


# ### Clustering Hiérarchique

# In[27]:


import scipy.spatial as sp, scipy.cluster.hierarchy as hc

df = p.DataFrame(distances)

for i in range(len(df)):
    df.iloc[i,i]=0


# La matrice doit être symmétrique.

# In[28]:


mat = df.values
mat = (mat + mat.T) / 2


# In[29]:


dist = sp.distance.squareform(mat)


# In[30]:


from pkg_resources import parse_version
import scipy
if parse_version(scipy.__version__) <= parse_version('0.17.1'):
    # Il peut y avoir quelques soucis avec la méthode Ward
    data_link = hc.linkage(dist, method='single')
else:
    data_link = hc.linkage(dist, method='ward')


# In[31]:


fig = plt.figure( figsize=(8,8) )
g = sns.clustermap(df, row_linkage=data_link, col_linkage=data_link)                
# instance de l'objet axes, c'est un peu caché :)
ax = g.ax_heatmap;


# On voit que les documents sont globalement assez différents les uns des autres.

# ## Exercice 5

# Comparaison des différentes fonctions de distances.

# In[32]:


import json
import nltk


path = 'ressources_googleplus/107033731246200681024.json'
data = json.loads(open(path).read())

# Nombre de co-occurrences à trouver

N = 25

all_tokens = [token for activity in data for token in               activity['object']['content'].lower().split()]

finder = nltk.BigramCollocationFinder.from_words(all_tokens)
finder.apply_freq_filter(2)

#filtre des mots trop fréquents

finder.apply_word_filter(lambda w: w in nltk.corpus.stopwords.words('english'))

bim = nltk.collocations.BigramAssocMeasures()

distances_func = [bim.raw_freq, bim.jaccard, bim.dice, bim.student_t,                 bim.chi_sq, bim.likelihood_ratio, bim.pmi]

collocations={}
collocations_sets={}

for d in distances_func:
    collocations[d] = finder.nbest(d,N)
    collocations_sets[d] = set([' '.join(c) for c in collocations[d]])
    print('\n')
    print(d)
    for collocation in collocations[d]:
        c = ' '.join(collocation)
        print(c)


# Pour comparer les sets deux à deux, on peut calculer de nouveau une distance de jaccard... des sets de collocations.

# In[33]:


for d1 in distances_func:
    for d2 in distances_func:
        if d1 != d2:
            jac = len(collocations_sets[d1].intersection(collocations_sets[d2])) /                   len(collocations_sets[d1].union(collocations_sets[d2]))
            if jac > 0.8:
                print('Méthode de distances comparables')
                print(jac,'\n'+str(d1),'\n'+str(d2))
                print('\n')

print('\n')
print('\n')
for d1 in distances_func:
    for d2 in distances_func:
        if d1 != d2:
            jac = len(collocations_sets[d1].intersection(collocations_sets[d2])) /                   len(collocations_sets[d1].union(collocations_sets[d2]))               
            if jac < 0.2:
                print('Méthode de distances avec des résultats très différents')
                print(jac,'\n'+str(d1),'\n'+str(d2))
                print('\n')


# In[34]:


import json
import nltk


path = 'ressources_googleplus/107033731246200681024.json'
data = json.loads(open(path).read())

# Nombre de co-occurrences à trouver

N = 25

all_tokens = [token for activity in data for token in               activity['object']['content'].lower().split()]

finder = nltk.TrigramCollocationFinder.from_words(all_tokens)
finder.apply_freq_filter(2)

#filtre des mots trop fréquents

finder.apply_word_filter(lambda w: w in nltk.corpus.stopwords.words('english'))

trigram_measures = nltk.collocations.TrigramAssocMeasures()

collocations = finder.nbest(trigram_measures.jaccard, N)

for collocation in collocations:
    c = ' '.join(collocation)
    print(c)