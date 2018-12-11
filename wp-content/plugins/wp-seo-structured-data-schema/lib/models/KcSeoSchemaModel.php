<?php

if (!class_exists('KcSeoSchemaModel')):
    class KcSeoSchemaModel
    {

        function __construct() {

        }

        function schemaOutput($schemaID, $metaData) {
            $html = null;

            if ($schemaID) {
                global $KcSeoWPSchema;
                switch ($schemaID) {
                    case "article":
                        $article = array();
                        $article["@context"] = "http://schema.org";
                        $article["@type"] = "Article";
                        if (!empty($metaData['headline'])) {
                            $article["headline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $article["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $KcSeoWPSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $article["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $article["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['alternativeHeadline'])) {
                            $article["alternativeHeadline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['alternativeHeadline']);
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $article["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $article["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $article["dateModified"] = $KcSeoWPSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['description'])) {
                            $article["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $article["articleBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode($article);
                        break;

                    case "news_article":
                        $newsArticle = array();
                        $newsArticle["@context"] = "http://schema.org";
                        $newsArticle["@type"] = "NewsArticle";
                        if (!empty($metaData['headline'])) {
                            $newsArticle["headline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $newsArticle["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $KcSeoWPSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $newsArticle["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $newsArticle["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $newsArticle["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $newsArticle["dateModified"] = $KcSeoWPSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $newsArticle["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['description'])) {
                            $newsArticle["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $newsArticle["articleBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode($newsArticle);
                        break;

                    case "blog_posting":
                        $blogPosting = array();
                        $blogPosting["@context"] = "http://schema.org";
                        $blogPosting["@type"] = "BlogPosting";
                        if (!empty($metaData['headline'])) {
                            $blogPosting["headline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $blogPosting["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $KcSeoWPSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $blogPosting["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $blogPosting["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $blogPosting["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $blogPosting["dateModified"] = $KcSeoWPSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $blogPosting["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['description'])) {
                            $blogPosting["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $blogPosting["articleBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode($blogPosting);
                        break;

                    case 'event':
                        $event = array();
                        $event["@context"] = "http://schema.org";
                        $event["@type"] = "Event";
                        if (!empty($metaData['name'])) {
                            $event["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['startDate'])) {
                            $event["startDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['startDate']);
                        }
                        if (!empty($metaData['endDate'])) {
                            $event["endDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['endDate']);
                        }
                        if (!empty($metaData['description'])) {
                            $event["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['performerName'])) {
                            $event["performer"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['performerName'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $event["image"] = $KcSeoWPSchema->sanitizeOutPut($metaData['image'], 'url');
                        }
                        if (!empty($metaData['locationName'])) {
                            $event["location"] = array(
                                "@type"   => "Place",
                                "name"    => $KcSeoWPSchema->sanitizeOutPut($metaData['locationName']),
                                "address" => $KcSeoWPSchema->sanitizeOutPut($metaData['locationAddress'])
                            );
                        }
                        if (!empty($metaData['price'])) {
                            $event["offers"] = array(
                                "@type"         => "Offer",
                                "price"         => $KcSeoWPSchema->sanitizeOutPut($metaData['price']),
                                "priceCurrency" => !empty($metaData['priceCurrency']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['priceCurrency']) : null,
                                "url"           => !empty($metaData['url']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['url'],
                                    'url') : null
                            );
                        }
                        if (!empty($metaData['url'])) {
                            $event["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode($event);
                        break;

                    case 'product':
                        $product = array();
                        $product["@context"] = "http://schema.org";
                        $product["@type"] = "Product";
                        if (!empty($metaData['name'])) {
                            $product["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $product["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['description'])) {
                            $product["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description']);
                        }
                        if (!empty($metaData['brand'])) {
                            $product["brand"] = array(
                                "@type" => "Thing",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['brand'])
                            );
                        }
                        if (!empty($metaData['ratingValue'])) {
                            $product["aggregateRating"] = array(
                                "@type"       => "AggregateRating",
                                "ratingValue" => !empty($metaData['ratingValue']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['ratingValue']) : null,
                                "reviewCount" => !empty($metaData['reviewCount']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['reviewCount']) : null
                            );
                        }
                        if (!empty($metaData['price'])) {
                            $product["offers"] = array(
                                "@type"         => "Offer",
                                "price"         => $KcSeoWPSchema->sanitizeOutPut($metaData['price']),
                                "priceCurrency" => !empty($metaData['priceCurrency']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['priceCurrency']) : null,
                                "itemCondition" => !empty($metaData['itemCondition']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['itemCondition']) : null,
                                "availability"  => !empty($metaData['availability']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['availability']) : null,
                                "url"           => !empty($metaData['url']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['url']) : null
                            );
                        }
                        $html .= $this->get_jsonEncode($product);
                        break;

                    case 'video':
                        $video = array();
                        $video["@context"] = "http://schema.org";
                        $video["@type"] = "VideoObject";
                        if (!empty($metaData['name'])) {
                            $video["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $video["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['description'])) {
                            $video["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description']);
                        }
                        if (!empty($metaData['thumbnailUrl'])) {
                            $video["thumbnailUrl"] = $KcSeoWPSchema->sanitizeOutPut($metaData['thumbnailUrl'], 'url');
                        }
                        if (!empty($metaData['uploadDate'])) {
                            $video["uploadDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['uploadDate']);
                        }
                        if (!empty($metaData['duration'])) {
                            $video["duration"] = $KcSeoWPSchema->sanitizeOutPut($metaData['duration']);
                        }
                        if (!empty($metaData['contentUrl'])) {
                            $video["contentUrl"] = $KcSeoWPSchema->sanitizeOutPut($metaData['contentUrl'], 'url');
                        }
                        if (!empty($metaData['interactionCount'])) {
                            $video["interactionCount"] = $KcSeoWPSchema->sanitizeOutPut($metaData['interactionCount']);
                        }
                        if (!empty($metaData['expires'])) {
                            $video["expires"] = $KcSeoWPSchema->sanitizeOutPut($metaData['expires']);
                        }
                        $html .= $this->get_jsonEncode($video);
                        break;

                    case 'service':
                        $service = array();
                        $service["@context"] = "http://schema.org";
                        $service["@type"] = "Service";
                        if (!empty($metaData['name'])) {
                            $service["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['serviceType'])) {
                            $service["serviceType"] = $KcSeoWPSchema->sanitizeOutPut($metaData['serviceType']);
                        }
                        /*
						if ( ! empty( $metaData['locationName'] ) ) {
							$service["location"] = array(
								"@type"   => "Place",
								"name"    => $KcSeoWPSchema->sanitizeOutPut( $metaData['locationName'] ),
								"address" => $KcSeoWPSchema->sanitizeOutPut( $metaData['locationAddress'] )
							);
						}*/
                        if (!empty($metaData['award'])) {
                            $service["award"] = $KcSeoWPSchema->sanitizeOutPut($metaData['award']);
                        }
                        if (!empty($metaData['category'])) {
                            $service["category"] = $KcSeoWPSchema->sanitizeOutPut($metaData['category']);
                        }
                        if (!empty($metaData['providerMobility'])) {
                            $service["providerMobility"] = $KcSeoWPSchema->sanitizeOutPut($metaData['providerMobility']);
                        }
                        if (!empty($metaData['additionalType'])) {
                            $service["additionalType"] = $KcSeoWPSchema->sanitizeOutPut($metaData['additionalType']);
                        }
                        if (!empty($metaData['alternateName'])) {
                            $service["alternateName"] = $KcSeoWPSchema->sanitizeOutPut($metaData['alternateName']);
                        }
                        if (!empty($metaData['image'])) {
                            $service["image"] = $KcSeoWPSchema->sanitizeOutPut($metaData['image']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $service["mainEntityOfPage"] = $KcSeoWPSchema->sanitizeOutPut($metaData['mainEntityOfPage']);
                        }
                        if (!empty($metaData['sameAs'])) {
                            $service["sameAs"] = $KcSeoWPSchema->sanitizeOutPut($metaData['sameAs']);
                        }
                        if (!empty($metaData['url'])) {
                            $service["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode($service);
                        break;

                    case 'review':
                        $review = array();
                        $review["@context"] = "http://schema.org";
                        $review["@type"] = "Review";
                        if (!empty($metaData['itemName'])) {
                            $review["itemReviewed"] = array(
                                "@type" => "Thing",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['itemName'])
                            );
                        }
                        if (!empty($metaData['ratingValue'])) {
                            $review["reviewRating"] = array(
                                "@type"       => "Rating",
                                "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['ratingValue']),
                                "bestRating"  => $KcSeoWPSchema->sanitizeOutPut($metaData['bestRating']),
                                "worstRating" => $KcSeoWPSchema->sanitizeOutPut($metaData['worstRating'])
                            );
                        }
                        if (!empty($metaData['name'])) {
                            $review["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['author'])) {
                            $review["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['reviewBody'])) {
                            $review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['reviewBody']);
                        }
                        if (!empty($metaData['datePublished'])) {
                            $review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['publisher'])) {
                            $review["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher'])
                            );
                        }
                        $html .= $this->get_jsonEncode($review);
                        break;
                    case 'aggregate_rating':
                        $aRating = array();
                        $aRating["@context"] = "http://schema.org";
                        $aRating["@type"] = !empty($metaData['schema_type']) ? $metaData['schema_type'] : "LocalBusiness";
                        if (!empty($metaData['name'])) {
                            $aRating["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $aRating["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if ($aRating["@type"] != "Organization") {
                            if (!empty($metaData['image'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                                $aRating["image"] = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            }
                            if (!empty($metaData['priceRange'])) {
                                $aRating["priceRange"] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceRange']);
                            }
                            if (!empty($metaData['telephone'])) {
                                $aRating["telephone"] = $KcSeoWPSchema->sanitizeOutPut($metaData['telephone']);
                            }

                            if (!empty($metaData['address'])) {
                                $aRating["address"] = $KcSeoWPSchema->sanitizeOutPut($metaData['address']);
                            }
                        }

                        if (!empty($metaData['ratingValue'])) {
                            $rValue = array();
                            $rValue["@type"] = "AggregateRating";
                            $rValue["ratingValue"] = $KcSeoWPSchema->sanitizeOutPut($metaData['ratingValue']);
                            if (!empty($metaData['bestRating'])) {
                                $rValue["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['bestRating']);
                            }
                            if (!empty($metaData['worstRating'])) {
                                $rValue["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['worstRating']);
                            }
                            if (!empty($metaData['ratingCount'])) {
                                $rValue["ratingCount"] = $KcSeoWPSchema->sanitizeOutPut($metaData['ratingCount']);
                            }

                            $aRating["aggregateRating"] = $rValue;
                        }
                        $html .= $this->get_jsonEncode($aRating);
                        break;

                    case 'restaurant':
                        $restaurant = array();
                        $restaurant["@context"] = "http://schema.org";
                        $restaurant["@type"] = "Restaurant";
                        if (!empty($metaData['name'])) {
                            $restaurant["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $restaurant["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['openingHours'])) {
                            $restaurant["openingHours"] = $KcSeoWPSchema->sanitizeOutPut($metaData['openingHours'],
                                'textarea');
                        }
                        if (!empty($metaData['telephone'])) {
                            $restaurant["telephone"] = $KcSeoWPSchema->sanitizeOutPut($metaData['telephone']);
                        }
                        if (!empty($metaData['menu'])) {
                            $restaurant["menu"] = $KcSeoWPSchema->sanitizeOutPut($metaData['menu'], 'url');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $restaurant["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['address'])) {
                            $restaurant["address"] = $KcSeoWPSchema->sanitizeOutPut($metaData['address'], 'textarea');
                        }
                        if (!empty($metaData['priceRange'])) {
                            $restaurant["priceRange"] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceRange']);
                        }
                        if (!empty($metaData['servesCuisine'])) {
                            $restaurant["servesCuisine"] = $KcSeoWPSchema->sanitizeOutPut($metaData['servesCuisine']);
                        }
                        $html .= $this->get_jsonEncode($restaurant);
                        break;

                    case 'localBusiness':
                        $localBusiness = array();
                        $localBusiness["@context"] = "http://schema.org";
                        $localBusiness["@type"] = "LocalBusiness";
                        if (!empty($metaData['name'])) {
                            $localBusiness["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $localBusiness["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $localBusiness["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['priceRange'])) {
                            $localBusiness["priceRange"] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceRange']);
                        }
                        if (!empty($metaData['addressLocality']) || !empty($metaData['addressRegion'])
                            || !empty($metaData['postalCode']) || !empty($metaData['streetAddress'])) {
                            $localBusiness["address"] = array(
                                "@type"           => "PostalAddress",
                                "addressLocality" => $KcSeoWPSchema->sanitizeOutPut($metaData['addressLocality']),
                                "addressRegion"   => $KcSeoWPSchema->sanitizeOutPut($metaData['addressRegion']),
                                "postalCode"      => $KcSeoWPSchema->sanitizeOutPut($metaData['postalCode']),
                                "streetAddress"   => $KcSeoWPSchema->sanitizeOutPut($metaData['streetAddress'])
                            );
                        }

                        if (!empty($metaData['telephone'])) {
                            $localBusiness["telephone"] = $KcSeoWPSchema->sanitizeOutPut($metaData['telephone']);
                        }
                        $html .= $this->get_jsonEncode($localBusiness);
                        break;

                    default:
                        break;
                }

            }

            return $html;
        }

        function get_field($data) {
            $html = null;
            global $KcSeoWPSchema;
            $id = $data['id'];
            $name = $data['name'];
            $value = $data['value'];
            $attr = !empty($data['attr']) ? $data['attr'] : null;

            $class = isset($data['class']) ? ($data['class'] ? $data['class'] : null) : null;
            $require = (isset($data['required']) ? ($data['required'] ? "<span class='required'>*</span>" : null) : null);
            $title = (isset($data['title']) ? ($data['title'] ? $data['title'] : null) : null);
            $desc = (isset($data['desc']) ? ($data['desc'] ? $data['desc'] : null) : null);
            $holderClass = (!empty($data['holderClass']) ? $data['holderClass'] : null);
            $html .= "<div class='field-container {$holderClass}' id='" . $id . '-container' . "'>";
            $html .= "<label class='field-label' for='{$id}'>{$title}{$require}</label>";
            $html .= "<div class='field-content' id='" . $id . '-content' . "'>";
            switch ($data['type']) {
                case 'checkbox':
                    $checked = ($value ? "checked" : null);
                    $html .= "<div class='kSeo-checkbox-wrapper'>";
                    $html .= "<label for='{$id}'><input type='checkbox' id='{$id}' class='{$class}' name='{$name}' {$checked} value='1' /> Enable</label>";
                    $html .= "</div>";
                    break;

                case 'text':
                    $html .= "<input type='text' id='{$id}' class='{$class}' name='{$name}' value='" . esc_html($value) . "' />";
                    break;

                case 'number':
                    $html .= "<input type='number' {$attr} id='{$id}' class='{$class}' name='{$name}' value='" . esc_attr($value) . "' />";
                    break;
                case 'textarea':
                    $html .= "<textarea id='{$id}' class='{$class}' name='{$name}' >" . wp_kses($value,
                            array()) . "</textarea>";
                    break;

                case 'image':
                    $html .= '<div class="kSeo-image">';
                    $ImageId = !empty($value) ? absint($value) : 0;
                    $image = $ingInfo = null;
                    if ($ImageId) {
                        $image = wp_get_attachment_image($ImageId, "thumbnail");
                        $imgData = $KcSeoWPSchema->imageInfo($ImageId);
                        $ingInfo .= "<span><strong>URL: </strong>{$imgData['url']}</span>";
                        $ingInfo .= "<span><strong>Width: </strong>{$imgData['width']}px</span>";
                        $ingInfo .= "<span><strong>Height: </strong>{$imgData['height']}px</span>";
                    }
                    $html .= "<div class='kSeo-image-wrapper'>";
                    $html .= '<span class="kSeoImgAdd"><span class="dashicons dashicons-plus-alt"></span></span>';
                    $html .= '<span class="kSeoImgRemove ' . ($image ? null : "kSeo-hidden") . '"><span class="dashicons dashicons-trash"></span></span>';
                    $html .= '<div class="kSeo-image-preview">' . $image . '</div>';
                    $html .= "<input type='hidden' name='{$name}' value='" . absint($ImageId) . "' />";
                    $html .= "</div>";
                    $html .= "<div class='image-info'>{$ingInfo}</div>";
                    $html .= '</div>';
                    break;
                case 'select':
                    $html .= "<select name='{$name}' class='select2 {$class}' id='{$id}'>";
                    if (!empty($data['empty'])) {
                        $html .= "<option value=''>{$data['empty']}</option>";
                    }
                    if (!empty($data['options']) && is_array($data['options'])) {
                        if ($this->isAssoc($data['options'])) {
                            foreach ($data['options'] as $optKey => $optValue) {
                                $slt = ($optKey == $value ? "selected" : null);
                                $html .= "<option value='" . esc_attr($optKey) . "' {$slt}>" . esc_html($optValue) . "</option>";
                            }
                        } else {
                            foreach ($data['options'] as $optValue) {
                                $slt = ($optValue == $value ? "selected" : null);
                                $html .= "<option value='" . esc_attr($optValue) . "' {$slt}>" . esc_html($optValue) . "</option>";
                            }
                        }
                    }
                    $html .= "</select>";
                    break;
                case 'schema_type':
                    $html .= "<select name='{$name}' class='select2 {$class}' id='{$id}'>";
                    if (!empty($data['empty'])) {
                        $html .= "<option value=''>{$data['empty']}</option>";
                    }

                    foreach ($data['options'] as $key => $site) {
                        if (is_array($site)) {
                            $slt = ($key == $value ? "selected" : null);
                            $html .= "<option value='$key' $slt>&nbsp;&nbsp;&nbsp;$key</option>";
                            foreach ($site as $inKey => $inSite) {
                                if (is_array($inSite)) {
                                    $slt = ($inKey == $value ? "selected" : null);
                                    $html .= "<option value='$inKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inKey</option>";
                                    foreach ($inSite as $inInKey => $inInSite) {
                                        if (is_array($inInSite)) {
                                            $slt = ($inInKey == $value ? "selected" : null);
                                            $html .= "<option value='$inInKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInKey</option>";
                                            foreach ($inInSite as $iSite) {
                                                $slt = ($iSite == $value ? "selected" : null);
                                                $html .= "<option value='$iSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$iSite</option>";
                                            }
                                        } else {
                                            $slt = ($inInSite == $value ? "selected" : null);
                                            $html .= "<option value='$inInSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInSite</option>";
                                        }
                                    }
                                } else {
                                    $slt = ($inSite == $value ? "selected" : null);
                                    $html .= "<option value='$inSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inSite</option>";
                                }
                            }
                        } else {
                            $slt = ($site == $value ? "selected" : null);
                            $html .= "<option value='$site' $slt>$site</option>";
                        }
                    }
                    $html .= "</select>";
                    break;
                default:
                    $html .= "<input id='{$id}' type='{$data['type']}' value='" . esc_attr($value) . "' name='$name' />";
                    break;

            }
            $html .= "<p class='description'>{$desc}</p>";
            $html .= "</div>";
            $html .= "</div>";

            return $html;
        }

        public function schemaTypes() {
            return array(
                'article'          => array(
                    'pro'    => false,
                    'title'  => __("Article", "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'              => array(
                            'type' => 'checkbox'
                        ),
                        'headline'            => array(
                            'title'    => __('Headline', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Article title', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'mainEntityOfPage'    => array(
                            'title'    => __('Page URL', "wp-seo-structured-data-schema"),
                            'type'     => 'url',
                            'desc'     => __('The canonical URL of the article page', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'author'              => array(
                            'title'    => __('Author Name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Author display name', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'image'               => array(
                            'title'    => __('Article Feature Image', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'required' => true,
                            'desc'     => __('Images should be at least 696 pixels wide.<br>Images should be in .jpg, .png, or. gif format.', "wp-seo-structured-data-schema")
                        ),
                        'datePublished'       => array(
                            'title'    => __('Published date', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'class'    => 'kcseo-date',
                            'required' => true,
                            'desc'     => __('Like this: 2015-12-25', "wp-seo-structured-data-schema")
                        ),
                        'dateModified'        => array(
                            'title'    => __('Modified date', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'class'    => 'kcseo-date',
                            'required' => true,
                            'desc'     => __('Like this: 2015-12-25', "wp-seo-structured-data-schema")
                        ),
                        'publisher'           => array(
                            'title'    => __('Publisher', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Publisher name or Organization name', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'publisherImage'      => array(
                            'title'    => __('Publisher Logo', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'desc'     => __('Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'description'         => array(
                            'title' => __('Description', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __('Short description', "wp-seo-structured-data-schema")
                        ),
                        'articleBody'         => array(
                            'title' => __('Article body', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __('Article content', "wp-seo-structured-data-schema")
                        ),
                        'alternativeHeadline' => array(
                            'title' => __('Alternative headline', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('A secondary headline for the article.', "wp-seo-structured-data-schema")
                        ),
                    )
                ),
                'blog_posting'     => array(
                    'pro'    => false,
                    'title'  => __('Blog Posting', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'headline'         => array(
                            'title'    => __('Headline', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Blog posting title', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'mainEntityOfPage' => array(
                            'title'    => __('Page URL', "wp-seo-structured-data-schema"),
                            'type'     => 'url',
                            'desc'     => __('The canonical URL of the article page', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'author'           => array(
                            'title'    => __('Author name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Author display name', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'image'            => array(
                            'title'    => __('Feature Image', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'desc'     => __("The representative image of the article. Only a marked-up image that directly belongs to the article should be specified.<br> Images should be at least 696 pixels wide. <br>Images should be in .jpg, .png, or. gif format.", "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'datePublished'    => array(
                            'title'    => __('Published date', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'class'    => 'kcseo-date',
                            'desc'     => __('Like this: 2015-12-25', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'dateModified'     => array(
                            'title'    => __('Modified date', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'class'    => 'kcseo-date',
                            'desc'     => __('Like this: 2015-12-25', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'publisher'        => array(
                            'title'    => __('Publisher', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Publisher name or Organization name', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'publisherImage'   => array(
                            'title'    => __('Publisher Logo', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'desc'     => __("Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>", "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'description'      => array(
                            'title' => __('Description', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __('Short description', "wp-seo-structured-data-schema")
                        ),
                        'articleBody'      => array(
                            'title' => __('Article body', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __('Article content', "wp-seo-structured-data-schema")
                        )
                    )
                ),
                'news_article'     => array(
                    'pro'    => false,
                    'title'  => __('News Article', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'headline'         => array(
                            'title'    => __('Headline', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Article title', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'mainEntityOfPage' => array(
                            'title'    => __('Page URL', "wp-seo-structured-data-schema"),
                            'type'     => 'url',
                            'desc'     => __('The canonical URL of the article page', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'author'           => array(
                            'title'    => __('Author', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Author display name', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'image'            => array(
                            'title'    => __('Image', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'desc'     => __("The representative image of the article. Only a marked-up image that directly belongs to the article should be specified.<br> Images should be at least 696 pixels wide. <br>Images should be in .jpg, .png, or. gif format.", "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'datePublished'    => array(
                            'title'    => __('Published date', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'class'    => 'kcseo-date',
                            'desc'     => __('Like this: 2015-12-25', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'dateModified'     => array(
                            'title'    => __('Modified date', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'class'    => 'kcseo-date',
                            'required' => true,
                            'desc'     => __('Like this: 2015-12-25', "wp-seo-structured-data-schema")
                        ),
                        'publisher'        => array(
                            'title'    => __('Publisher', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'desc'     => __('Publisher name or Organization name', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'publisherImage'   => array(
                            'title'    => __('Publisher Logo', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'desc'     => __('Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>', "wp-seo-structured-data-schema"),
                            'required' => true
                        ),
                        'description'      => array(
                            'title' => __('Description', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __('Short description', "wp-seo-structured-data-schema")
                        ),
                        'articleBody'      => array(
                            'title' => __('Article body', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __('Article body content', "wp-seo-structured-data-schema")
                        )
                    )
                ),
                'event'            => array(
                    'pro'    => false,
                    'title'  => __('Event', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'          => array(
                            'type' => 'checkbox'
                        ),
                        'name'            => array(
                            'title'    => __('Name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The name of the event.", "wp-seo-structured-data-schema")
                        ),
                        'locationName'    => array(
                            'title'    => __('Location name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("Event Location name", "wp-seo-structured-data-schema")
                        ),
                        'locationAddress' => array(
                            'title'    => __('Location address', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The location of for example where the event is happening, an organization is located, or where an action takes place.", "wp-seo-structured-data-schema")
                        ),
                        'startDate'       => array(
                            'title'    => __('Start date', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'class'    => 'kcseo-date',
                            'required' => true,
                            'desc'     => __("Event start date", "wp-seo-structured-data-schema")
                        ),
                        'endDate'         => array(
                            'title' => __('End date (Recommended)', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => __("Event end date", "wp-seo-structured-data-schema")
                        ),
                        'description'     => array(
                            'title' => __('Description (Recommended)', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __("Event description", "wp-seo-structured-data-schema")
                        ),
                        'performerName'   => array(
                            'title' => __('Performer Name (Recommended)', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("The performer's name.", "wp-seo-structured-data-schema")
                        ),
                        'image'           => array(
                            'title' => __('Image URL (Recommended)', "wp-seo-structured-data-schema"),
                            'type'  => 'url',
                            'desc'  => __("URL of an image or logo for the event or tour", "wp-seo-structured-data-schema")
                        ),
                        'price'           => array(
                            'title' => __('Price (Recommended)', "wp-seo-structured-data-schema"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("This is highly recommended. The lowest available price, including service charges and fees, of this type of ticket. <span class='required'>Not required but (Recommended)</span>", "wp-seo-structured-data-schema")
                        ),
                        'priceCurrency'   => array(
                            'title' => __('Price currency', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("The 3-letter currency code. (USD)", "wp-seo-structured-data-schema")
                        ),
                        'url'             => array(
                            'title'       => 'URL (Recommended)',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("A link to the event's details page. <span class='required'>Not required but (Recommended)</span>", "wp-seo-structured-data-schema")
                        ),
                    )
                ),
                'product'          => array(
                    'pro'    => false,
                    'title'  => __('Product', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'        => array(
                            'type' => 'checkbox'
                        ),
                        'name'          => array(
                            'title'    => __('Name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The name of the product.", "wp-seo-structured-data-schema")
                        ),
                        'image'         => array(
                            'title' => __('Image', "wp-seo-structured-data-schema"),
                            'type'  => 'image',
                            'desc'  => __("The URL of a product photo. Pictures clearly showing the product, e.g. against a white background, are preferred.", "wp-seo-structured-data-schema")
                        ),
                        'description'   => array(
                            'title' => __('Description', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __("Product description.", "wp-seo-structured-data-schema")
                        ),
                        'brand'         => array(
                            'title' => __('Brand', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("The brand of the product.", "wp-seo-structured-data-schema")
                        ),
                        'ratingValue'   => array(
                            'title' => __('Ratting value', "wp-seo-structured-data-schema"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("Rating value. (1 , 2.5, 3, 5 etc)", "wp-seo-structured-data-schema")
                        ),
                        'reviewCount'   => array(
                            'title' => __('Total review count', "wp-seo-structured-data-schema"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("Rating ratting value. <span class='required'>This is required if (Ratting value) is given</span>", "wp-seo-structured-data-schema")
                        ),
                        'price'         => array(
                            'title' => __('Price', "wp-seo-structured-data-schema"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("The lowest available price, including service charges and fees, of this type of ticket.", "wp-seo-structured-data-schema")
                        ),
                        'priceCurrency' => array(
                            'title' => __('Price currency', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("The 3-letter currency code.", "wp-seo-structured-data-schema")
                        ),
                        'availability'  => array(
                            'title'   => 'Availability',
                            'type'    => 'select',
                            'empty'   => "Select one",
                            'options' => array(
                                'http://schema.org/InStock'             => 'InStock',
                                'http://schema.org/InStoreOnly'         => 'InStoreOnly',
                                'http://schema.org/OutOfStock'          => 'OutOfStock',
                                'http://schema.org/SoldOut'             => 'SoldOut',
                                'http://schema.org/OnlineOnly'          => 'OnlineOnly',
                                'http://schema.org/LimitedAvailability' => 'LimitedAvailability',
                                'http://schema.org/Discontinued'        => 'Discontinued',
                                'http://schema.org/PreOrder'            => 'PreOrder',
                            ),
                            'desc'    => __("Select a availability type", "wp-seo-structured-data-schema")
                        ),
                        'itemCondition' => array(
                            'title'   => 'Product condition',
                            'type'    => 'select',
                            'empty'   => "Select one",
                            'options' => array(
                                'http://schema.org/NewCondition'         => 'NewCondition',
                                'http://schema.org/UsedCondition'        => 'UsedCondition',
                                'http://schema.org/DamagedCondition'     => 'DamagedCondition',
                                'http://schema.org/RefurbishedCondition' => 'RefurbishedCondition',
                            ),
                            'desc'    => __("Select a condition", "wp-seo-structured-data-schema")
                        ),
                        'url'           => array(
                            'title' => __('Product URL', "wp-seo-structured-data-schema"),
                            'type'  => 'url',
                            'desc'  => __("A URL to the product web page (that includes the Offer). (Don't use offerURL for markup that appears on the product page itself.)", "wp-seo-structured-data-schema")
                        ),
                    )
                ),
                'video'            => array(
                    'pro'    => false,
                    'title'  => __('Video', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'name'             => array(
                            'title'    => __('Name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The title of the video", "wp-seo-structured-data-schema")
                        ),
                        'description'      => array(
                            'title'    => __('Description', "wp-seo-structured-data-schema"),
                            'type'     => 'textarea',
                            'required' => true,
                            'desc'     => __("The description of the video", "wp-seo-structured-data-schema")
                        ),
                        'thumbnailUrl'     => array(
                            'title'       => 'Thumbnail URL',
                            'type'        => 'url',
                            'placeholder' => "URL",
                            'required'    => true,
                            'desc'        => __("A URL pointing to the video thumbnail image file. Images must be at least 160x90 pixels and at most 1920x1080 pixels.", "wp-seo-structured-data-schema")
                        ),
                        'uploadDate'       => array(
                            'title' => __('Updated date', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => __('2015-02-05T08:00:00+08:00', "wp-seo-structured-data-schema")
                        ),
                        'duration'         => array(
                            'title' => __('Duration', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("The duration of the video in ISO 8601 format.(PT1M33S)", "wp-seo-structured-data-schema")
                        ),
                        'contentUrl'       => array(
                            'title'       => 'Content URL',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("A URL pointing to the actual video media file. This file should be in .mpg, .mpeg, .mp4, .m4v, .mov, .wmv, .asf, .avi, .ra, .ram, .rm, .flv, or other video file format.", "wp-seo-structured-data-schema")
                        ),
                        'embedUrl'         => array(
                            'title'       => 'Embed URL',
                            'placeholder' => 'URL',
                            'type'        => 'url',
                            'desc'        => __("A URL pointing to a player for the specific video. Usually this is the information in the src element of an < embed> tag.Example: Dailymotion: http://www.dailymotion.com/swf/x1o2g.", "wp-seo-structured-data-schema")
                        ),
                        'interactionCount' => array(
                            'title' => __('Interaction count', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("The number of times the video has been viewed.", "wp-seo-structured-data-schema")
                        ),
                        'expires'          => array(
                            'title' => __('Expires', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => __("Like this: 2015-12-25", "wp-seo-structured-data-schema")
                        ),
                    )
                ),
                'service'          => array(
                    'pro'    => false,
                    'title'  => __('Service', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'           => array(
                            'type' => 'checkbox'
                        ),
                        'name'             => array(
                            'title'    => __('Name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The name of the Service.", "wp-seo-structured-data-schema")
                        ),
                        'serviceType'      => array(
                            'title'    => __('Service type', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The type of service being offered, e.g. veterans' benefits, emergency relief, etc.", "wp-seo-structured-data-schema")
                        ),
                        'additionalType'   => array(
                            'title'       => 'Additional type(URL)',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("An additional type for the service, typically used for adding more specific types from external vocabularies in microdata syntax.", "wp-seo-structured-data-schema")
                        ),
                        'award'            => array(
                            'title' => __('Award', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("An award won by or for this service.", "wp-seo-structured-data-schema")
                        ),
                        'category'         => array(
                            'title' => __('Category', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("A category for the service.", "wp-seo-structured-data-schema")
                        ),
                        'providerMobility' => array(
                            'title' => __('Provider mobility', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("Indicates the mobility of a provided service (e.g. 'static', 'dynamic').", "wp-seo-structured-data-schema")
                        ),
                        'description'      => array(
                            'title'   => 'Description',
                            'type'    => 'textarea',
                            'require' => true,
                            'desc'    => __("A short description of the service.", "wp-seo-structured-data-schema")
                        ),
                        'image'            => array(
                            'title'   => 'Image URL',
                            'type'    => 'url',
                            'require' => false,
                            'desc'    => __("An image of the service. This should be a URL.", "wp-seo-structured-data-schema")
                        ),
                        'mainEntityOfPage' => array(
                            'title'   => 'Main entity of page URL',
                            'type'    => 'url',
                            'require' => false,
                            'desc'    => __("Indicates a page (or other CreativeWork) for which this thing is the main entity being described.", "wp-seo-structured-data-schema")
                        ),
                        'sameAs'           => array(
                            'title'       => 'Same as URL',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("URL of a reference Web page that unambiguously indicates the service's identity. E.g. the URL of the service's Wikipedia page, Freebase page, or official website.", "wp-seo-structured-data-schema")
                        ),
                        'url'              => array(
                            'title'       => 'Url of the service',
                            'type'        => 'url',
                            'placeholder' => 'URL',
                            'desc'        => __("URL of the service.", "wp-seo-structured-data-schema")
                        ),
                        'alternateName'    => array(
                            'title' => __('Alternate name', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('An alias for the service.', "wp-seo-structured-data-schema")
                        ),
                    )
                ),
                'review'           => array(
                    'pro'    => false,
                    'title'  => __('Review', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'        => array(
                            'type' => 'checkbox'
                        ),
                        'itemName'      => array(
                            'title'    => __('Name of the reviewed item', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The item that is being reviewed.", "wp-seo-structured-data-schema")
                        ),
                        'reviewBody'    => array(
                            'title'    => __('Review body', "wp-seo-structured-data-schema"),
                            'type'     => 'textarea',
                            'required' => true,
                            'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema")
                        ),
                        'name'          => array(
                            'title'    => __('Review name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("A particular name for the review.", "wp-seo-structured-data-schema")
                        ),
                        'author'        => array(
                            'title'    => __('Author', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'author'   => 'Author name',
                            'desc'     => __("The author of the review. The reviewer’s name needs to be a valid name.", "wp-seo-structured-data-schema")
                        ),
                        'datePublished' => array(
                            'title' => __('Date of Published', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'class' => 'kcseo-date',
                            'desc'  => __("Like this: 2015-12-25", "wp-seo-structured-data-schema")
                        ),
                        'ratingValue'   => array(
                            'title' => __('Rating value', "wp-seo-structured-data-schema"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema")
                        ),
                        'bestRating'    => array(
                            'title' => __('Best rating', "wp-seo-structured-data-schema"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema")
                        ),
                        'worstRating'   => array(
                            'title' => __('Worst rating', "wp-seo-structured-data-schema"),
                            'type'  => 'number',
                            'attr'  => 'step="any"',
                            'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema")
                        ),
                        'publisher'     => array(
                            'title' => __('Name of the organization', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('The publisher of the review.', "wp-seo-structured-data-schema")
                        )
                    )
                ),
                'aggregate_rating' => array(
                    'pro'    => false,
                    'title'  => __('Aggregate Ratings', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'      => array(
                            'type' => 'checkbox'
                        ),
                        'schema_type' => array(
                            'title'    => __('Schema type', "wp-seo-structured-data-schema"),
                            'type'     => 'schema_type',
                            'required' => true,
                            'options'  => $this->site_type(),
                            'empty'    => "Select one",
                            'desc'     => __("Use the most appropriate schema type for what is being reviewed.", "wp-seo-structured-data-schema")
                        ),
                        'name'        => array(
                            'title'    => __('Name of the item', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true,
                            'desc'     => __("The item that is being rated.", "wp-seo-structured-data-schema")
                        ),
                        'image'       => array(
                            'title'       => 'Image',
                            'type'        => 'image',
                            'required'    => true,
                            'holderClass' => 'kSeo-hidden aggregate-except-organization-holder'
                        ),
                        'priceRange'  => array(
                            'title'       => 'Price Range (Recommended)',
                            'type'        => 'text',
                            'holderClass' => 'kSeo-hidden aggregate-except-organization-holder',
                            'desc'        => __("The price range of the business, for example $$$.", "wp-seo-structured-data-schema")
                        ),
                        'telephone'   => array(
                            'title'       => 'Telephone (Recommended)',
                            'type'        => 'text',
                            'holderClass' => 'kSeo-hidden aggregate-except-organization-holder'
                        ),
                        'address'     => array(
                            'title'       => 'Address (Recommended)',
                            'type'        => 'text',
                            'holderClass' => 'kSeo-hidden aggregate-except-organization-holder',
                        ),
                        'description' => array(
                            'title' => __('Description', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __("Description for thr review", "wp-seo-structured-data-schema")
                        ),
                        'ratingCount' => array(
                            'title'    => __('Rating Count', "wp-seo-structured-data-schema"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("The total number of ratings for the item on your site. <span class='required'>* At least one of ratingCount or reviewCount is required.</span>", "wp-seo-structured-data-schema")
                        ),
                        'reviewCount' => array(
                            'title'    => __('Review Count', "wp-seo-structured-data-schema"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("Specifies the number of people who provided a review with or without an accompanying rating. At least one of ratingCount or reviewCount is required.", "wp-seo-structured-data-schema")
                        ),
                        'ratingValue' => array(
                            'title'    => __('Rating Value', "wp-seo-structured-data-schema"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema")
                        ),
                        'ratingValue' => array(
                            'title'    => __('Rating Value', "wp-seo-structured-data-schema"),
                            'attr'     => 'step="any"',
                            'type'     => 'number',
                            'required' => true,
                            'desc'     => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema")
                        ),
                        'bestRating'  => array(
                            'title'    => __('Best Rating', "wp-seo-structured-data-schema"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("The highest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If bestRating is omitted, 5 is assumed.", "wp-seo-structured-data-schema")
                        ),
                        'worstRating' => array(
                            'title'    => __('Worst Rating', "wp-seo-structured-data-schema"),
                            'type'     => 'number',
                            'attr'     => 'step="any"',
                            'required' => true,
                            'desc'     => __("The lowest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema")
                        )
                    )
                ),
                'restaurant'       => array(
                    'pro'    => false,
                    'title'  => __('Restaurant', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'        => array(
                            'type' => 'checkbox'
                        ),
                        'name'          => array(
                            'title'    => __('Name of the Restaurant', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true
                        ),
                        'description'   => array(
                            'title' => __('Description of the Restaurant', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                        ),
                        'openingHours'  => array(
                            'title' => __('Opening Hours', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                            'desc'  => __('Mo,Tu,We,Th,Fr,Sa,Su 11:30-23:00', "wp-seo-structured-data-schema")
                        ),
                        'telephone'     => array(
                            'title' => __('Opening Hours', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('+155501003333', "wp-seo-structured-data-schema")
                        ),
                        'menu'          => array(
                            'title' => __('Menu', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('http://example.com/menu', "wp-seo-structured-data-schema")
                        ),
                        'image'         => array(
                            'title'    => __('Image', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'required' => true
                        ),
                        'address'       => array(
                            'title' => __('Address', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea'
                        ),
                        'priceRange'    => array(
                            'title' => __('Price Range', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('The price range of the business, for example $$$', "wp-seo-structured-data-schema")
                        ),
                        'servesCuisine' => array(
                            'title' => __('Serves Cuisine', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('The cuisine of the restaurant.', "wp-seo-structured-data-schema")
                        )
                    )
                ),
                'localBusiness'    => array(
                    'pro'    => false,
                    'title'  => __('Local Business', "wp-seo-structured-data-schema"),
                    'fields' => array(
                        'active'          => array(
                            'type' => 'checkbox'
                        ),
                        'name'            => array(
                            'title'    => __('Name', "wp-seo-structured-data-schema"),
                            'type'     => 'text',
                            'required' => true
                        ),
                        'description'     => array(
                            'title' => __('Description', "wp-seo-structured-data-schema"),
                            'type'  => 'textarea',
                        ),
                        'image'           => array(
                            'title'    => __('Business Logo', "wp-seo-structured-data-schema"),
                            'type'     => 'image',
                            'required' => true
                        ),
                        'priceRange'      => array(
                            'title' => __('Price Range (Recommended)', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __("The price range of the business, for example $$$.", "wp-seo-structured-data-schema")
                        ),
                        'addressLocality' => array(
                            'title' => __('Address locality', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('City (i.e Kansas city)', "wp-seo-structured-data-schema")
                        ),
                        'addressRegion'   => array(
                            'title' => __('Address region', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                            'desc'  => __('State (i.e. MO)', "wp-seo-structured-data-schema")
                        ),
                        'postalCode'      => array(
                            'title' => __('Postal code', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                        ),
                        'streetAddress'   => array(
                            'title' => __('Street address', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                        ),
                        'telephone'       => array(
                            'title' => __('Telephone (Recommended)', "wp-seo-structured-data-schema"),
                            'type'  => 'text',
                        )
                    )
                ),
                'book'             => array(
                    'pro'   => true,
                    'title' => __("Book", "wp-seo-structured-data-schema"),
                ),
                'course'           => array(
                    'pro'   => true,
                    'title' => __("Course", "wp-seo-structured-data-schema"),
                ),
                'JobPosting'       => array(
                    'pro'   => true,
                    'title' => __("Job Posting", "wp-seo-structured-data-schema"),
                ),
                'movie'            => array(
                    'pro'   => true,
                    'title' => __("Movie", "wp-seo-structured-data-schema"),
                ),
                'music'            => array(
                    'pro'   => true,
                    'title' => __("Music", "wp-seo-structured-data-schema"),
                ),
                'recipe'           => array(
                    'pro'   => true,
                    'title' => __("Recipe", "wp-seo-structured-data-schema"),
                ),
                'TVEpisode'        => array(
                    'pro'   => true,
                    'title' => __("TVEpisode", "wp-seo-structured-data-schema"),
                ),
                'question'         => array(
                    'pro'   => true,
                    'title' => __("QAPage", "wp-seo-structured-data-schema"),
                ),
            );
        }

        function get_jsonEncode($data = array()) {
            $html = null;
            /** @var TYPE_NAME $data */
            if (!empty($data) && is_array($data)) {
                $html .= '<script type="application/ld+json">' . json_encode($data,
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
            }

            return $html;
        }

        function site_type() {
            return array(
                'Organization',
                'LocalBusiness' => array(
                    'AnimalShelter',
                    'AutomotiveBusiness'          => array(
                        'AutoBodyShop',
                        'AutoDealer',
                        'AutoPartsStore',
                        'AutoRental',
                        'AutoRepair',
                        'AutoWash',
                        'GasStation',
                        'MotorcycleDealer',
                        'MotorcycleRepair'
                    ),
                    'ChildCare',
                    'DryCleaningOrLaundry',
                    'EmergencyService',
                    'EmploymentAgency',
                    'EntertainmentBusiness'       => array(
                        'AdultEntertainment',
                        'AmusementPark',
                        'ArtGallery',
                        'Casino',
                        'ComedyClub',
                        'MovieTheater',
                        'NightClub',

                    ),
                    'FinancialService'            => array(
                        'AccountingService',
                        'AutomatedTeller',
                        'BankOrCreditUnion',
                        'InsuranceAgency',
                    ),
                    'FoodEstablishment'           => array(
                        'Bakery',
                        'BarOrPub',
                        'Brewery',
                        'CafeOrCoffeeShop',
                        'FastFoodRestaurant',
                        'IceCreamShop',
                        'Restaurant',
                        'Winery',
                    ),
                    'GovernmentOffice',
                    'HealthAndBeautyBusiness'     => array(
                        'BeautySalon',
                        'DaySpa',
                        'HairSalon',
                        'HealthClub',
                        'NailSalon',
                        'TattooParlor',
                    ),
                    'HomeAndConstructionBusiness' => array(
                        'Electrician',
                        'GeneralContractor',
                        'HVACBusiness',
                        'HousePainter',
                        'Locksmith',
                        'MovingCompany',
                        'Plumber',
                        'RoofingContractor',
                    ),
                    'InternetCafe',
                    'LegalService'                => array(
                        'Attorney',
                        'Notary',
                    ),
                    'Library',
                    'MedicalBusiness'             => array(
                        'CommunityHealth',
                        'Dentist',
                        'Dermatology',
                        'DietNutrition',
                        'Emergency',
                        'Geriatric',
                        'Gynecologic',
                        'MedicalClinic',
                        'Midwifery',
                        'Nursing',
                        'Obstetric',
                        'Oncologic',
                        'Optician',
                        'Optometric',
                        'Otolaryngologic',
                        'Pediatric',
                        'Pharmacy',
                        'Physician',
                        'Physiotherapy',
                        'PlasticSurgery',
                        'Podiatric',
                        'PrimaryCare',
                        'Psychiatric',
                        'PublicHealth',
                    ),
                    'LodgingBusiness'             => array(
                        'BedAndBreakfast',
                        'Campground',
                        'Hostel',
                        'Hotel',
                        'Motel',
                        'Resort',
                    ),
                    'ProfessionalService',
                    'RadioStation',
                    'RealEstateAgent',
                    'RecyclingCenter',
                    'SelfStorage',
                    'ShoppingCenter',
                    'SportsActivityLocation'      => array(
                        'BowlingAlley',
                        'ExerciseGym',
                        'GolfCourse',
                        'HealthClub',
                        'PublicSwimmingPool',
                        'SkiResort',
                        'SportsClub',
                        'StadiumOrArena',
                        'TennisComplex',
                    ),
                    'Store'                       => array(
                        'AutoPartsStore',
                        'BikeStore',
                        'BookStore',
                        'ClothingStore',
                        'ComputerStore',
                        'ConvenienceStore',
                        'DepartmentStore',
                        'ElectronicsStore',
                        'Florist',
                        'FurnitureStore',
                        'GardenStore',
                        'GroceryStore',
                        'HardwareStore',
                        'HobbyShop',
                        'HomeGoodsStore',
                        'JewelryStore',
                        'LiquorStore',
                        'MensClothingStore',
                        'MobilePhoneStore',
                        'MovieRentalStore',
                        'MusicStore',
                        'OfficeEquipmentStore',
                        'OutletStore',
                        'PawnShop',
                        'PetStore',
                        'ShoeStore',
                        'SportingGoodsStore',
                        'TireShop',
                        'ToyStore',
                        'WholesaleStore'
                    ),
                    'TelevisionStation',
                    'TouristInformationCenter',
                    'TravelAgency'
                )
            );
        }

        function countryList() {
            return array(
                "AF" => "Afghanistan",
                "AX" => "Aland Islands",
                "AL" => "Albania",
                "DZ" => "Algeria",
                "AS" => "American Samoa",
                "AD" => "Andorra",
                "AO" => "Angola",
                "AI" => "Anguilla",
                "AQ" => "Antarctica",
                "AG" => "Antigua and Barbuda",
                "AR" => "Argentina",
                "AM" => "Armenia",
                "AW" => "Aruba",
                "AU" => "Australia",
                "AT" => "Austria",
                "AZ" => "Azerbaijan",
                "BS" => "Bahamas",
                "BH" => "Bahrain",
                "BD" => "Bangladesh",
                "BB" => "Barbados",
                "BY" => "Belarus",
                "BE" => "Belgium",
                "BZ" => "Belize",
                "BJ" => "Benin",
                "BM" => "Bermuda",
                "BT" => "Bhutan",
                "BO" => "Bolivia, Plurinational State of",
                "BQ" => "Bonaire, Sint Eustatius and Saba",
                "BA" => "Bosnia and Herzegovina",
                "BW" => "Botswana",
                "BV" => "Bouvet Island",
                "BR" => "Brazil",
                "IO" => "British Indian Ocean Territory",
                "BN" => "Brunei Darussalam",
                "BG" => "Bulgaria",
                "BF" => "Burkina Faso",
                "BI" => "Burundi",
                "KH" => "Cambodia",
                "CM" => "Cameroon",
                "CA" => "Canada",
                "CV" => "Cape Verde",
                "KY" => "Cayman Islands",
                "CF" => "Central African Republic",
                "TD" => "Chad",
                "CL" => "Chile",
                "CN" => "China",
                "CX" => "Christmas Island",
                "CC" => "Cocos (Keeling) Islands",
                "CO" => "Colombia",
                "KM" => "Comoros",
                "CG" => "Congo",
                "CD" => "Congo, the Democratic Republic of the",
                "CK" => "Cook Islands",
                "CR" => "Costa Rica",
                "CI" => "Côte d Ivoire",
                "HR" => "Croatia",
                "CU" => "Cuba",
                "CW" => "Curaçao",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "DK" => "Denmark",
                "DJ" => "Djibouti",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "EC" => "Ecuador",
                "EG" => "Egypt",
                "SV" => "El Salvador",
                "GQ" => "Equatorial Guinea",
                "ER" => "Eritrea",
                "EE" => "Estonia",
                "ET" => "Ethiopia",
                "FK" => "Falkland Islands (Malvinas)",
                "FO" => "Faroe Islands",
                "FJ" => "Fiji",
                "FI" => "Finland",
                "FR" => "France",
                "GF" => "French Guiana",
                "PF" => "French Polynesia",
                "TF" => "French Southern Territories",
                "GA" => "Gabon",
                "GM" => "Gambia",
                "GE" => "Georgia",
                "DE" => "Germany",
                "GH" => "Ghana",
                "GI" => "Gibraltar",
                "GR" => "Greece",
                "GL" => "Greenland",
                "GD" => "Grenada",
                "GP" => "Guadeloupe",
                "GU" => "Guam",
                "GT" => "Guatemala",
                "GG" => "Guernsey",
                "GN" => "Guinea",
                "GW" => "Guinea-Bissau",
                "GY" => "Guyana",
                "HT" => "Haiti",
                "HM" => "Heard Island and McDonald Islands",
                "VA" => "Holy See (Vatican City State)",
                "HN" => "Honduras",
                "HK" => "Hong Kong",
                "HU" => "Hungary",
                "IS" => "Iceland",
                "IN" => "India",
                "ID" => "Indonesia",
                "IR" => "Iran, Islamic Republic of",
                "IQ" => "Iraq",
                "IE" => "Ireland",
                "IM" => "Isle of Man",
                "IL" => "Israel",
                "IT" => "Italy",
                "JM" => "Jamaica",
                "JP" => "Japan",
                "JE" => "Jersey",
                "JO" => "Jordan",
                "KZ" => "Kazakhstan",
                "KE" => "Kenya",
                "KI" => "Kiribati",
                "KP" => "Korea, Democratic People's Republic of",
                "KR" => "Korea, Republic of,",
                "KW" => "Kuwait",
                "KG" => "Kyrgyzstan",
                "LA" => "Lao Peoples Democratic Republic",
                "LV" => "Latvia",
                "LB" => "Lebanon",
                "LS" => "Lesotho",
                "LR" => "Liberia",
                "LY" => "Libya",
                "LI" => "Liechtenstein",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "MO" => "Macao",
                "MK" => "Macedonia, the former Yugoslav Republic of",
                "MG" => "Madagascar",
                "MW" => "Malawi",
                "MY" => "Malaysia",
                "MV" => "Maldives",
                "ML" => "Mali",
                "MT" => "Malta",
                "MH" => "Marshall Islands",
                "MQ" => "Martinique",
                "MR" => "Mauritania",
                "MU" => "Mauritius",
                "YT" => "Mayotte",
                "MX" => "Mexico",
                "FM" => "Micronesia, Federated States of",
                "MD" => "Moldova, Republic of",
                "MC" => "Monaco",
                "MN" => "Mongolia",
                "ME" => "Montenegro",
                "MS" => "Montserrat",
                "MA" => "Morocco",
                "MZ" => "Mozambique",
                "MM" => "Myanmar",
                "NA" => "Namibia",
                "NR" => "Nauru",
                "NP" => "Nepal",
                "NL" => "Netherlands",
                "NC" => "New Caledonia",
                "NZ" => "New Zealand",
                "NI" => "Nicaragua",
                "NE" => "Niger",
                "NG" => "Nigeria",
                "NU" => "Niue",
                "NF" => "Norfolk Island",
                "MP" => "Northern Mariana Islands",
                "NO" => "Norway",
                "OM" => "Oman",
                "PK" => "Pakistan",
                "PW" => "Palau",
                "PS" => "Palestine, State of",
                "PA" => "Panama",
                "PG" => "Papua New Guinea",
                "PY" => "Paraguay",
                "PE" => "Peru",
                "PH" => "Philippines",
                "PN" => "Pitcairn",
                "PL" => "Poland",
                "PT" => "Portugal",
                "PR" => "Puerto Rico",
                "QA" => "Qatar",
                "RE" => "Reunion",
                "RO" => "Romania",
                "RU" => "Russian Federation",
                "RW" => "Rwanda",
                "BL" => "Saint Barthélemy",
                "SH" => "Saint Helena, Ascension and Tristan da Cunha",
                "KN" => "Saint Kitts and Nevis",
                "LC" => "Saint Lucia",
                "MF" => "Saint Martin (French part)",
                "PM" => "Saint Pierre and Miquelon",
                "VC" => "Saint Vincent and the Grenadines",
                "WS" => "Samoa",
                "SM" => "San Marino",
                "ST" => "Sao Tome and Principe",
                "SA" => "Saudi Arabia",
                "SN" => "Senegal",
                "RS" => "Serbia",
                "SC" => "Seychelles",
                "SL" => "Sierra Leone",
                "SG" => "Singapore",
                "SX" => "Sint Maarten (Dutch part)",
                "SK" => "Slovakia",
                "SI" => "Slovenia",
                "SB" => "Solomon Islands",
                "SO" => "Somalia",
                "ZA" => "South Africa",
                "GS" => "South Georgia and the South Sandwich Islands",
                "SS" => "South Sudan",
                "ES" => "Spain",
                "LK" => "Sri Lanka",
                "SD" => "Sudan",
                "SR" => "Suriname",
                "SJ" => "Svalbard and Jan Mayen",
                "SZ" => "Swaziland",
                "SE" => "Sweden",
                "CH" => "Switzerland",
                "SY" => "Syrian Arab Republic",
                "TW" => "Taiwan, Province of China",
                "TJ" => "Tajikistan",
                "TZ" => "Tanzania, United Republic of",
                "TH" => "Thailand",
                "TL" => "Timor-Leste",
                "TG" => "Togo",
                "TK" => "Tokelau",
                "TO" => "Tonga",
                "TT" => "Trinidad and Tobago",
                "TN" => "Tunisia",
                "TR" => "Turkey",
                "TM" => "Turkmenistan",
                "TC" => "Turks and Caicos Islands",
                "TV" => "Tuvalu",
                "UG" => "Uganda",
                "UA" => "Ukraine",
                "AE" => "United Arab Emirates",
                "GB" => "United Kingdom",
                "US" => "United States",
                "UM" => "United States Minor Outlying Islands",
                "UY" => "Uruguay",
                "UZ" => "Uzbekistan",
                "VU" => "Vanuatu",
                "VE" => "Venezuela, Bolivarian Republic of",
                "VN" => "Viet Nam",
                "VG" => "Virgin Islands, British",
                "VI" => "Virgin Islands, U.S.",
                "WF" => "Wallis and Futuna",
                "EH" => "Western Sahara",
                "YE" => "Yemen",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe",
            );
        }

        function contactType() {
            return array(
                "Customer Service",
                "Technical Support",
                "Billing Support",
                "Bill Payment",
                "Sales",
                "Reservations",
                "Credit Card Support",
                "Emergency",
                "Baggage Tracking",
                "Roadside Assistance",
                "Package Tracking"
            );
        }

        function languageList() {
            return array(
                "Akan",
                "Amharic",
                "Arabic",
                "Assamese",
                "Awadhi",
                "Azerbaijani",
                "Balochi",
                "Belarusian",
                "Bengali",
                "Bhojpuri",
                "Burmese",
                "Cantonese",
                "Cebuano",
                "Chewa",
                "Chhattisgarhi",
                "Chittagonian",
                "Czech",
                "Deccan",
                "Dhundhari",
                "Dutch",
                "English",
                "French",
                "Fula",
                "Gan",
                "German",
                "Greek",
                "Gujarati",
                "Haitian Creole",
                "Hakka",
                "Haryanvi",
                "Hausa",
                "Hiligaynon",
                "Hindi / Urdu",
                "Hmong",
                "Hungarian",
                "Igbo",
                "Ilokano",
                "Italian",
                "Japanese",
                "Javanese",
                "Jin",
                "Kannada",
                "Kazakh",
                "Khmer",
                "Kinyarwanda",
                "Kirundi",
                "Konkani",
                "Korean",
                "Kurdish",
                "Madurese",
                "Magahi",
                "Maithili",
                "Malagasy",
                "Malay/Indonesian",
                "Malayalam",
                "Mandarin",
                "Marathi",
                "Marwari",
                "Min Bei",
                "Min Dong",
                "Min Nan",
                "Mossi",
                "Nepali",
                "Oriya",
                "Oromo",
                "Pashto",
                "Persian",
                "Polish",
                "Portuguese",
                "Punjabi",
                "Quechua",
                "Romanian",
                "Russian",
                "Saraiki",
                "Serbo-Croatian",
                "Shona",
                "Sindhi",
                "Sinhalese",
                "Somali",
                "Spanish",
                "Sundanese",
                "Swahili",
                "Swedish",
                "Sylheti",
                "Tagalog",
                "Tamil",
                "Telugu",
                "Thai",
                "Turkish",
                "Ukrainian",
                "Uyghur",
                "Uzbek",
                "Vietnamese",
                "Wu",
                "Xhosa",
                "Xiang",
                "Yoruba",
                "Zulu",
            );
        }

        function socialList() {
            return array(
                'facebook'    => __('Facebook'),
                'twitter'     => __('Twitter'),
                'google-plus' => __('Google+'),
                'instagram'   => __('Instagram'),
                'youtube'     => __('Youtube'),
                'linkedin'    => __('LinkedIn'),
                'myspace'     => __('Myspace'),
                'pinterest'   => __('Pinterest'),
                'soundcloud'  => __('SoundCloud'),
                'tumblr'      => __('Tumblr'),
                'wikidata'    => __('Wikidata'),
            );
        }

        function imgInfo($url = null) {
            $img = array();
            if ($url) {
                $imgA = @getimagesize($url);
                if (is_array($imgA) && !empty($imgA)) {
                    $img['width'] = $imgA[0];
                    $img['height'] = $imgA[1];
                } else {
                    $img['width'] = 0;
                    $img['height'] = 0;
                }
            }

            return $img;
        }

        function isAssoc($array) {
            $keys = array_keys($array);

            return $keys !== array_keys($keys);
        }


    }
endif;