__author__ = 'montanawong'
from clarifai.client import ClarifaiApi
from clarifai_basic import ClarifaiCustomModel

concept = ClarifaiCustomModel()
clarifai_api = ClarifaiApi() # assumes environment variables are set.
url = "http://cdn.hitfix.com/photos/5621843/Grumpy-Cat.jpg"

concept.positive(url, "nelly")
concept.train('nelly')


#result = #concept.predict('https://pbs.twimg.com/profile_images/616542814319415296/#McCTpH_E.jpg', 'nelly')

#confidence = result['urls'][0]['score']

#print confidence

#result = clarifai_api.tag_images(open('images/cat.jpg'))

result = clarifai_api.tag_image_urls(url)
print result