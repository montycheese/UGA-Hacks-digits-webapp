from classifications import language
count = 0
for model in language.keys():
	print "current model to train: %s, %d/%d complete" % (model, count, len(language))
	for url in language[model]:
		print "training url:%s on model %s" % (url, model)
	for key, value in language.iteritems():
		if key != model:
			for neg_url in value:
				print neg_url
	count += 1
	
print "\n\n**********TESTING COMPLETE************\n"