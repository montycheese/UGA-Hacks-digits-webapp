from clarifai_basic import ClarifaiCustomModel
from json import dumps
from classifications import language
import sys


def predict(url):
	concept = ClarifaiCustomModel()
	max_confidence = 0.0
	classification = None
	for word in language.keys():
		#print word
		result = concept.predict(url, word)
		confidence = result['urls'][0]['score']
		print word, confidence
		if confidence > max_confidence:
			max_confidence = confidence
			classification = word
	if classification == None:
		return None
	else:
		return (classification, max_confidence)

if(len(sys.argv) != 2):
	print "Correct command:$python predict.py [url]"
	exit(0)
image_url = sys.argv[1] 

print predict(image_url)
