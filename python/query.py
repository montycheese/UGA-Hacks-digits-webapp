__author__ = 'montanawong'
from clarifai.client import ClarifaiApi
from json import dumps
from classifications import applause, letter_a, letter_b

clarifai_api = ClarifaiApi() # assumes environment variables are set.
for url in applause:
	#result = clarifai_api.tag_images(open('images/cat.jpg'))
	result = clarifai_api.tag_image_urls(url)
	for result in result['results'][0]['result']['tag']['classes']:
		print dumps(result)
	#for result in result['results']:
	#	print dumps(result)
	