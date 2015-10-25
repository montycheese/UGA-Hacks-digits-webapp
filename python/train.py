from clarifai_basic import ClarifaiCustomModel
from json import dumps
from classifications import language

concept = ClarifaiCustomModel()

count = 0
for model in language.keys():
	print "current model to train: %s, %d/%d complete" % (model, count, len(language))
	for url in language[model]:
		print "training url:%s on model %s" % (url, model)
		concept.positive(url, model)
		
	for key, value in language.iteritems():
		if key != model:
			for neg_url in value:
				print neg_url
				concept.negative(neg_url, model)
	concept.train(model)
	count += 1

#print "making url:%s from model: %s a negative case." %(neg_url, key)



