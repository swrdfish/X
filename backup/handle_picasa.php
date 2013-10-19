<?php
class Picasa{
        private $userid = '114527766546168509668';

        public function getAlbums($thumbsize){
            $Albums = array();
            $feedURL = "https://picasaweb.google.com/data/feed/api/user/"
                        .$this->userid
                        ."?kind=album&access=public&v=2&imgmax="
                        .$thumbsize;
            $sxml = simplexml_load_file($feedURL);
            foreach ($sxml->entry as $entry) {
                $albumid = (string)$entry->children('gphoto', TRUE)->id;
                $title = (string)$entry->title;
                $media = $entry->children('media', TRUE);
                $content = $media->group->content;
                $imgurl = (string)$content->attributes()->{'url'};
                $Albums[] = array(
                                  'albumid' => $albumid,
                                  'url' => $imgurl,
                                  'title' => $title,
                                  );
                }
            return $Albums;
            }




            public function getAlbumPhotos($albumid, $thumbsize, $offset, $maxresult){

                $feedURL = "https://picasaweb.google.com/data/feed/api/user/"
                            .$this->userid
                            ."/albumid/"
                            .$albumid
                            ."?kind=photo&access=public&v=2&imgmax="
                            .$thumbsize
                            ."&start-index="
                            . $offset
                            ."&max-results="
                            .$maxresult;
                $sxml = simplexml_load_file($feedURL);
                $albumtitle = (string)$sxml->title;
                $numphotos = (string)$sxml->children('gphoto', TRUE)->numphotos;
                $Photos = array('albumtitle' => $albumtitle,
                                'numphotos' => $numphotos,
                                );
                foreach($sxml->entry as $entry){
                    $photoid = (string)$entry->children('gphoto', TRUE)->id;
                    $title = (string)$entry->summary;
                    $url = (string)$entry->content->attributes()->{'src'};
                    $exiftag = $entry->children('https://schemas.google.com/photos/exif/2007');
                    $exiftag = $exiftag->tags;
                    $exif = array(
                                'fstop' => (string)$exiftag->fstop,
                                'make' => (string)$exiftag->make,
                                'model' => (string)$exiftag->model,
                                'exposure' => (string)$exiftag->exposure,
                                'flash' => (string)$exiftag->flash,
                                'focallength' => (string)$exiftag->focallength,
                                'iso' => (string)$exiftag->iso,
                            );
                    $Photos[] = array(
                                    'photoid' => $photoid,
                                    'title' => $title,
                                    'url' => $url,
                                    'exif' => $exif,
                                    );
                    }
                return $Photos;
            }

            public function getRecentPhotos($thumbsize, $maxresult){
                $feedURL = "https://picasaweb.google.com/data/feed/api/user/"
                            .$this->userid
                            ."?kind=photo&access=public&v=2&imgmax="
                            .$thumbsize
                            ."&max-results="
                            .$maxresult;
                $sxml = simplexml_load_file($feedURL);
                $Photos = array();
                foreach($sxml->entry as $entry){
                    $photoid = (string)$entry->children('gphoto', TRUE)->id;
                    $title = (string)$entry->summary;
                    $url = (string)$entry->content->attributes()->{'src'};
                    $Photos[] = array(
                                    'photoid' => $photoid,
                                    'title' => $title,
                                    'url' => $url,
                                    );
                    }
                return $Photos;
                }

            public function getPhoto($photoid, $size){
                $feedURL = "https://picasaweb.google.com/data/feed/api/user/"
                            .$this->userid
                            ."/photoid/"
                            .$photoid
                            ."?access=public&imgmax="
                            .$size;
                $sxml = simplexml_load_file($feedURL);
                $title = (string)$sxml->subtitle;
                $filename = (string)$sxml->title;
                $url = (string)$sxml->children('media', TRUE)
                            ->group->content->attributes()->{'url'};
                $albumid = (string)$sxml->children('gphoto', TRUE)
                                ->albumid;
                $exiftag = $sxml->children('https://schemas.google.com/photos/exif/2007')->tags;
                $exif = array(
                            'fstop' => (string)$exiftag->fstop,
                            'make' => (string)$exiftag->make,
                            'model' => (string)$exiftag->model,
                            'exposure' => (string)$exiftag->exposure,
                            'flash' => (string)$exiftag->flash,
                            'focallength' => (string)$exiftag->focallength,
                            'iso' => (string)$exiftag->iso,
                            );
                $feedURL = "https://picasaweb.google.com/data/feed/api/user/"
                            .$this->userid
                            ."/albumid/"
                            .$albumid
                            ."?kind=photo&access=public&thumbnial=32";
                $sxml = simplexml_load_file($feedURL);
                $albumtitle = (string)$sxml->title;
                foreach($sxml->entry as $entry){
                    if($entry->children('gphoto', TRUE)->id == $photoid){
                        $prev = array(
                                    'id' => (string)$temp_id,
                                    'title' => (string)$temp_title,
                                    'url' => (string)$temp_url,
                                    );
                    }
                    if($temp_id == $photoid){
                        $temp_id = $entry->children('gphoto', TRUE)
                                ->id;
                        $temp_title = $entry->summary;
                        $temp_url = $entry->content->attributes()->{'src'};
                        $next = array(
                                    'id' => (string)$temp_id,
                                    'title' => (string)$temp_title,
                                    'url' => (string)$temp_url,
                                    );
                        continue;
                    }
                    $temp_id = $entry->children('gphoto', TRUE)
                                ->id;
                    $temp_title = $entry->summary;
                    $temp_url = $entry->content->attributes()->{'src'};
                }

                return $Photo = array(
                                    'id' => $photoid,
                                    'title' => $title,
                                    'url' => $url,
                                    'filename' => $filename,
                                    'albumid' => $albumid,
                                    'albumtitle' => $albumtitle,
                                    'exif' => $exif,
                                    'prev' => $prev,
                                    'next' => $next,);
            }
        }

$Picasa = new Picasa();
?>
