#!/usr/bin/spython3
import sys
import nltk

nltk.data.path = ['nltk_data']

#from nltk.corpus import stopwords
from nltk.tokenize import sent_tokenize, word_tokenize

message_tokenized = word_tokenize(sys.argv[1])

bad_message = 1

blacklist = ['abruti', 'chier', 'niquer', 'enculer', 'endauffer', 'foutre', 'mettre', 'andouille', 'appareilleuse', 'assimilé', 'astèque', 'avorton', 'bachi-bouzouk', 'baleine', 'bâtard', 'baudet', 'beauf', 'bellicole', 'bête', 'biatch', 'bic', 'bicot', 'bicotte', 'bite', 'bitembois', 'Bitembois', 'bordille', 'boucaque', 'boudin', 'bouffi', 'bouffon', 'bougnoul', 'bougnoule', 'Bougnoulie', 'bougnoulisation', 'bougnouliser', 'bougre', 'boukak', 'boulet', 'bounioul', 'bounioule', 'bourdille', 'bourricot', 'branleur', 'bridé', 'bridée', 'brigand', 'brise-burnes', 'cacou', 'cafre', 'cageot', 'caldoche', 'casse-bonbon', 'casse-couille', 'casse-couilles', 'cave', 'chagasse', 'chauffard', 'chiennasse', 'chienne', 'chier', 'chinetoc', 'chinetoque', 'chintok', 'chleuh', 'chnoque', 'citrouille', 'coche', 'colon', 'complotiste', 'con', 'conasse', 'conchier', 'connard', 'connarde', 'connasse', 'conspirationniste', 'couille', 'counifle', 'courtaud', 'CPF', 'crétin', 'crevure', 'cricri', 'crotté', 'crouillat', 'crouille', 'croûton', 'débile', 'doryphore', 'doxosophe', 'doxosophie', 'drouille', 'ducon', 'duconnot', 'dugenoux', 'dugland', 'duschnock', 'emmanché', 'emmerder', 'emmerdeur', 'emmerdeuse', 'empafé', 'empapaouté', 'enculé', 'enculé', 'enculer', 'putain', 'pute', 'salaud', 'enflure', 'enfoiré', 'envaselineur', 'épais', 'espingoin', 'étron', 'fachiste', 'FDP', 'fell', 'gueule', 'bâtard', 'fiotte', 'folle', 'fouteur', 'fripouille', 'frisé', 'fritz', 'Fritz', 'fumier', 'gaouri', 'garce', 'gaupe', 'GDM', 'gland', 'glandeur', 'glandeuse', 'glandouillou', 'glandu', 'gnoul', 'gnoule', 'Godon', 'gogol', 'goï', 'gook', 'gouilland', 'gouine', 'gourdasse', 'gourde', 'gourgandine', 'grognasse', 'gueniche', 'guindoule', 'gwer', 'imbécile', 'incapable', 'islamo-gauchisme', 'jean-foutre', 'jean-fesse', 'jeannette', 'journalope', 'kawish', 'kikoo', 'kikou', 'Kraut', 'lâche', 'lâcheux', 'lavette', 'lopette', 'magot', 'makoumé', 'manche', 'mange-merde', 'marchandot', 'margouilliste', 'marsouin', 'mauviette', 'melon', 'mercon', 'merdaille', 'merdaillon', 'merde', 'merdeux', 'merdouillard', 'michto', 'minable', 'minus', 'misérable', 'moinaille', 'moins-que-rien', 'monacaille', 'mongol', 'moricaud', 'naze', 'nazi', 'négro', 'niac', 'niafou', 'niaiseux', 'niakoué', 'nique', 'niquer', 'niquer', 'nodocéphale', 'NTM', 'nul', 'nulle', 'orchidoclaste', 'ordure', 'pakos', 'panoufle', 'patarin', 'PD', 'pédale', 'pédé', 'pédoque', 'pignouf', 'pignoufe', 'pissou', 'pithécanthrope', 'pleutre', 'plouc', 'pochard', 'porc', 'porcas', 'porcasse', 'pouf', 'pouffiasse', 'poufiasse', 'poulet', 'poundé', 'pourriture', 'punaise', 'putain', 'pute', 'putois', 'raclure', 'raté', 'retourne', 'aux', 'asperges', 'ripopée', 'robespierrot', 'rosbif', 'roulure', 'foutre', 'merde', 'sagouin', 'salaud', 'sale', 'salop', 'salope', 'sans-couilles', 'satrouille', 'sauvage', 'schlague', 'schleu', 'schnock', 'schnoque', 'sent-la-pisse', 'social-traître', 'sorcière', 'sottiseux', 'sous-merde', 'stéarique', 'tache', 'tafiole', 'tantouserie', 'tantouze', 'tapette', 'tapettitude', 'tarlouze', 'tata', 'tebé', 'téteux', 'teubé', 'Thénardier', 'tocard', 'traînée', 'cul', 'trouduc', 'truiasse', 'truie', 'vaurien', 'vendu', 'vert-de-gris', 'vide-couilles', 'viédase', 'vier', 'vieux', 'vieux', 'blanc', 'vipère', 'lubrique', 'weeaboo', 'xéropineur', 'youd', 'youp', 'youpin', 'youpine', 'youpinisation', 'youtre', 'zguègue']

whitelist = []

#with open('whitelist/lefff-2.1.txt', "r") as f:
#        for line in f:
#                whitelist.extend(line.split())

for w in message_tokenized:
        if w.lower() in blacklist:
                bad_message = 0
#        elif w.lower() not in whitelist:
#                bad_message = 0


sys.exit(bad_message)

#phrase_filtre = []
#phrase_filtre = [w for w in message_tokenized if not w in blacklist]

#if phrase_filtre != message_tokenized:
#    sys.exit(0)
#else:
#    sys.exit(1)

#print(exemple_texte)
#print(word_tokenize(exemple_texte))
#stop_wordf = set(stopwords.words("french"))

#print(stopwords.words("french"))

