<?php

namespace OmekaClassic\Representation\Parameters;


trait HasElementTexts
{
    /**
     * @param null $elementName
     * @return mixed|null
     */
    public function getElementTexts($elementName = null)
    {
        if(is_string($elementName)) {
            foreach ($this['element_texts'] as $element) {
                if($element['html']) { continue; }

                if($element['element']['name'] == $elementName) {
                    return $element['text'];
                }
            }

            return null;
        }

        return $this['element_texts'];
    }

    /**
     * @param string $text
     * @param int $elementId
     * @param bool $isHtml
     */
    public function addElementText(string $text, int $elementId, bool $isHtml = false)
    {
        $elementTests = $this['element_texts'] ?? [];

        $elementTests[] = [
            'html' => $isHtml,
            'text' => $text,
            'element' => (object) ['id' => $elementId]
        ];

        $this['element_texts'] = $elementTests;
    }
}
