<?php
/**
 * Simple Timezone Dropdown Field plugin for Craft CMS 3.x
 *
 * A simple dropdown field for timezones
 *
 * @link      https://www.webmenedzser.hu
 * @copyright Copyright (c) 2019 Ottó Radics
 */

namespace saboteur777\simpletimezonedropdownfield\fields;

use saboteur777\simpletimezonedropdownfield\TimezoneField;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\fields\data\OptionData;
use craft\fields\data\SingleOptionFieldData;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * Simple Timezone Dropdown Field
 *
 * Whenever someone creates a new field in Craft, they must specify what
 * type of field it is. The system comes with a handful of field types baked in,
 * and we’ve made it extremely easy for plugins to add new ones.
 *
 * https://craftcms.com/docs/plugins/field-types
 *
 * @author    Ottó Radics
 * @package   TimezoneField
 * @since     1.0.0
 */
class Timezone extends Field
{
    // Static Methods
    // =========================================================================

    /**
     * Returns the display name of this class.
     *
     * @return string The display name of this class.
     */
    public static function displayName(): string
    {
        return Craft::t('timezone-field', 'Timezone');
    }

    // Public Methods
    // =========================================================================

    /**
     * Returns the column type that this field should get within the content table.
     *
     * This method will only be called if [[hasContentColumn()]] returns true.
     *
     * @return string The column type. [[\yii\db\QueryBuilder::getColumnType()]] will be called
     * to convert the give column type to the physical one. For example, `string` will be converted
     * as `varchar(255)` and `string(100)` becomes `varchar(100)`. `not null` will automatically be
     * appended as well.
     * @see \yii\db\QueryBuilder::getColumnType()
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_STRING;
    }

    /**
     * Normalizes the field’s value for use.
     *
     * This method is called when the field’s value is first accessed from the element. For example, the first time
     * `entry.myFieldHandle` is called from a template, or right before [[getInputHtml()]] is called. Whatever
     * this method returns is what `entry.myFieldHandle` will likewise return, and what [[getInputHtml()]]’s and
     * [[serializeValue()]]’s $value arguments will be set to.
     *
     * @param mixed                 $value   The raw field value
     * @param ElementInterface|null $element The element the field is associated with, if there is one
     *
     * @return mixed The prepared field value
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        return $value;
    }

    /**
     * Modifies an element query.
     *
     * This method will be called whenever elements are being searched for that may have this field assigned to them.
     *
     * If the method returns `false`, the query will be stopped before it ever gets a chance to execute.
     *
     * @param ElementQueryInterface $query The element query
     * @param mixed                 $value The value that was set on this field’s corresponding [[ElementCriteriaModel]] param,
     *                                     if any.
     *
     * @return null|false `false` in the event that the method is sure that no elements are going to be found.
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * Returns the field’s input HTML.
     *
     * @param mixed                 $value           The field’s value. This will either be the [[normalizeValue() normalized value]],
     *                                               raw POST data (i.e. if there was a validation error), or null
     * @param ElementInterface|null $element         The element the field is associated with, if there is one
     *
     * @return string The input HTML.
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
        $namespacedId = Craft::$app->getView()->namespaceInputId($id);

        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'timezone-field/_components/fields/_select',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'id' => $id,
                'namespacedId' => $namespacedId,
                'options' => $this->timezones()
            ]
        );
    }


    public function timezones() : array
    {
        $timezones = [
            ['label' => 'ACDT', 'value' => 'ACDT'],
            ['label' => 'ACST', 'value' => 'ACST'],
            ['label' => 'ACT', 'value' => 'ACT'],
            ['label' => 'ACT', 'value' => 'ACT'],
            ['label' => 'ACWST', 'value' => 'ACWST'],
            ['label' => 'ADT', 'value' => 'ADT'],
            ['label' => 'AEDT', 'value' => 'AEDT'],
            ['label' => 'AEST', 'value' => 'AEST'],
            ['label' => 'AFT', 'value' => 'AFT'],
            ['label' => 'AKDT', 'value' => 'AKDT'],
            ['label' => 'AKST', 'value' => 'AKST'],
            ['label' => 'ALMT', 'value' => 'ALMT'],
            ['label' => 'AMST', 'value' => 'AMST'],
            ['label' => 'AMT', 'value' => 'AMT'],
            ['label' => 'AMT', 'value' => 'AMT'],
            ['label' => 'ANAT', 'value' => 'ANAT'],
            ['label' => 'AQTT', 'value' => 'AQTT'],
            ['label' => 'ART', 'value' => 'ART'],
            ['label' => 'AST', 'value' => 'AST'],
            ['label' => 'AST', 'value' => 'AST'],
            ['label' => 'AWST', 'value' => 'AWST'],
            ['label' => 'AZOST', 'value' => 'AZOST'],
            ['label' => 'AZOT', 'value' => 'AZOT'],
            ['label' => 'AZT', 'value' => 'AZT'],
            ['label' => 'BDT', 'value' => 'BDT'],
            ['label' => 'BIOT', 'value' => 'BIOT'],
            ['label' => 'BIT', 'value' => 'BIT'],
            ['label' => 'BOT', 'value' => 'BOT'],
            ['label' => 'BRST', 'value' => 'BRST'],
            ['label' => 'BRT', 'value' => 'BRT'],
            ['label' => 'BST', 'value' => 'BST'],
            ['label' => 'BST', 'value' => 'BST'],
            ['label' => 'BST', 'value' => 'BST'],
            ['label' => 'BTT', 'value' => 'BTT'],
            ['label' => 'CAT', 'value' => 'CAT'],
            ['label' => 'CCT', 'value' => 'CCT'],
            ['label' => 'CDT', 'value' => 'CDT'],
            ['label' => 'CDT', 'value' => 'CDT'],
            ['label' => 'CEST', 'value' => 'CEST'],
            ['label' => 'CET', 'value' => 'CET'],
            ['label' => 'CHADT', 'value' => 'CHADT'],
            ['label' => 'CHAST', 'value' => 'CHAST'],
            ['label' => 'CHOT', 'value' => 'CHOT'],
            ['label' => 'CHOST', 'value' => 'CHOST'],
            ['label' => 'CHST', 'value' => 'CHST'],
            ['label' => 'CHUT', 'value' => 'CHUT'],
            ['label' => 'CIST', 'value' => 'CIST'],
            ['label' => 'CIT', 'value' => 'CIT'],
            ['label' => 'CKT', 'value' => 'CKT'],
            ['label' => 'CLST', 'value' => 'CLST'],
            ['label' => 'CLT', 'value' => 'CLT'],
            ['label' => 'COST', 'value' => 'COST'],
            ['label' => 'COT', 'value' => 'COT'],
            ['label' => 'CST', 'value' => 'CST'],
            ['label' => 'CST', 'value' => 'CST'],
            ['label' => 'CST', 'value' => 'CST'],
            ['label' => 'CT', 'value' => 'CT'],
            ['label' => 'CVT', 'value' => 'CVT'],
            ['label' => 'CWST', 'value' => 'CWST'],
            ['label' => 'CXT', 'value' => 'CXT'],
            ['label' => 'DAVT', 'value' => 'DAVT'],
            ['label' => 'DDUT', 'value' => 'DDUT'],
            ['label' => 'DFT', 'value' => 'DFT'],
            ['label' => 'EASST', 'value' => 'EASST'],
            ['label' => 'EAST', 'value' => 'EAST'],
            ['label' => 'EAT', 'value' => 'EAT'],
            ['label' => 'ECT', 'value' => 'ECT'],
            ['label' => 'ECT', 'value' => 'ECT'],
            ['label' => 'EDT', 'value' => 'EDT'],
            ['label' => 'EEST', 'value' => 'EEST'],
            ['label' => 'EET', 'value' => 'EET'],
            ['label' => 'EGST', 'value' => 'EGST'],
            ['label' => 'EGT', 'value' => 'EGT'],
            ['label' => 'EIT', 'value' => 'EIT'],
            ['label' => 'EST', 'value' => 'EST'],
            ['label' => 'FET', 'value' => 'FET'],
            ['label' => 'FJT', 'value' => 'FJT'],
            ['label' => 'FKST', 'value' => 'FKST'],
            ['label' => 'FKT', 'value' => 'FKT'],
            ['label' => 'FNT', 'value' => 'FNT'],
            ['label' => 'GALT', 'value' => 'GALT'],
            ['label' => 'GAMT', 'value' => 'GAMT'],
            ['label' => 'GET', 'value' => 'GET'],
            ['label' => 'GFT', 'value' => 'GFT'],
            ['label' => 'GILT', 'value' => 'GILT'],
            ['label' => 'GIT', 'value' => 'GIT'],
            ['label' => 'GMT', 'value' => 'GMT'],
            ['label' => 'GST', 'value' => 'GST'],
            ['label' => 'GST', 'value' => 'GST'],
            ['label' => 'GYT', 'value' => 'GYT'],
            ['label' => 'HDT', 'value' => 'HDT'],
            ['label' => 'HAEC', 'value' => 'HAEC'],
            ['label' => 'HST', 'value' => 'HST'],
            ['label' => 'HKT', 'value' => 'HKT'],
            ['label' => 'HMT', 'value' => 'HMT'],
            ['label' => 'HOVST', 'value' => 'HOVST'],
            ['label' => 'HOVT', 'value' => 'HOVT'],
            ['label' => 'ICT', 'value' => 'ICT'],
            ['label' => 'IDLW', 'value' => 'IDLW'],
            ['label' => 'IDT', 'value' => 'IDT'],
            ['label' => 'IOT', 'value' => 'IOT'],
            ['label' => 'IRDT', 'value' => 'IRDT'],
            ['label' => 'IRKT', 'value' => 'IRKT'],
            ['label' => 'IRST', 'value' => 'IRST'],
            ['label' => 'IST', 'value' => 'IST'],
            ['label' => 'IST', 'value' => 'IST'],
            ['label' => 'IST', 'value' => 'IST'],
            ['label' => 'JST', 'value' => 'JST'],
            ['label' => 'KALT', 'value' => 'KALT'],
            ['label' => 'KGT', 'value' => 'KGT'],
            ['label' => 'KOST', 'value' => 'KOST'],
            ['label' => 'KRAT', 'value' => 'KRAT'],
            ['label' => 'KST', 'value' => 'KST'],
            ['label' => 'LHST', 'value' => 'LHST'],
            ['label' => 'LHST', 'value' => 'LHST'],
            ['label' => 'LINT', 'value' => 'LINT'],
            ['label' => 'MAGT', 'value' => 'MAGT'],
            ['label' => 'MART', 'value' => 'MART'],
            ['label' => 'MAWT', 'value' => 'MAWT'],
            ['label' => 'MDT', 'value' => 'MDT'],
            ['label' => 'MET', 'value' => 'MET'],
            ['label' => 'MEST', 'value' => 'MEST'],
            ['label' => 'MHT', 'value' => 'MHT'],
            ['label' => 'MIST', 'value' => 'MIST'],
            ['label' => 'MIT', 'value' => 'MIT'],
            ['label' => 'MMT', 'value' => 'MMT'],
            ['label' => 'MSK', 'value' => 'MSK'],
            ['label' => 'MST', 'value' => 'MST'],
            ['label' => 'MST', 'value' => 'MST'],
            ['label' => 'MUT', 'value' => 'MUT'],
            ['label' => 'MVT', 'value' => 'MVT'],
            ['label' => 'MYT', 'value' => 'MYT'],
            ['label' => 'NCT', 'value' => 'NCT'],
            ['label' => 'NDT', 'value' => 'NDT'],
            ['label' => 'NFT', 'value' => 'NFT'],
            ['label' => 'NOVT', 'value' => 'NOVT'],
            ['label' => 'NPT', 'value' => 'NPT'],
            ['label' => 'NST', 'value' => 'NST'],
            ['label' => 'NT', 'value' => 'NT'],
            ['label' => 'NUT', 'value' => 'NUT'],
            ['label' => 'NZDT', 'value' => 'NZDT'],
            ['label' => 'NZST', 'value' => 'NZST'],
            ['label' => 'OMST', 'value' => 'OMST'],
            ['label' => 'ORAT', 'value' => 'ORAT'],
            ['label' => 'PDT', 'value' => 'PDT'],
            ['label' => 'PET', 'value' => 'PET'],
            ['label' => 'PETT', 'value' => 'PETT'],
            ['label' => 'PGT', 'value' => 'PGT'],
            ['label' => 'PHOT', 'value' => 'PHOT'],
            ['label' => 'PHT', 'value' => 'PHT'],
            ['label' => 'PKT', 'value' => 'PKT'],
            ['label' => 'PMDT', 'value' => 'PMDT'],
            ['label' => 'PMST', 'value' => 'PMST'],
            ['label' => 'PONT', 'value' => 'PONT'],
            ['label' => 'PST', 'value' => 'PST'],
            ['label' => 'PST', 'value' => 'PST'],
            ['label' => 'PYST', 'value' => 'PYST'],
            ['label' => 'PYT', 'value' => 'PYT'],
            ['label' => 'RET', 'value' => 'RET'],
            ['label' => 'ROTT', 'value' => 'ROTT'],
            ['label' => 'SAKT', 'value' => 'SAKT'],
            ['label' => 'SAMT', 'value' => 'SAMT'],
            ['label' => 'SAST', 'value' => 'SAST'],
            ['label' => 'SBT', 'value' => 'SBT'],
            ['label' => 'SCT', 'value' => 'SCT'],
            ['label' => 'SDT', 'value' => 'SDT'],
            ['label' => 'SGT', 'value' => 'SGT'],
            ['label' => 'SLST', 'value' => 'SLST'],
            ['label' => 'SRET', 'value' => 'SRET'],
            ['label' => 'SRT', 'value' => 'SRT'],
            ['label' => 'SST', 'value' => 'SST'],
            ['label' => 'SST', 'value' => 'SST'],
            ['label' => 'SYOT', 'value' => 'SYOT'],
            ['label' => 'TAHT', 'value' => 'TAHT'],
            ['label' => 'THA', 'value' => 'THA'],
            ['label' => 'TFT', 'value' => 'TFT'],
            ['label' => 'TJT', 'value' => 'TJT'],
            ['label' => 'TKT', 'value' => 'TKT'],
            ['label' => 'TLT', 'value' => 'TLT'],
            ['label' => 'TMT', 'value' => 'TMT'],
            ['label' => 'TRT', 'value' => 'TRT'],
            ['label' => 'TOT', 'value' => 'TOT'],
            ['label' => 'TVT', 'value' => 'TVT'],
            ['label' => 'ULAST', 'value' => 'ULAST'],
            ['label' => 'ULAT', 'value' => 'ULAT'],
            ['label' => 'UTC', 'value' => 'UTC'],
            ['label' => 'UYST', 'value' => 'UYST'],
            ['label' => 'UYT', 'value' => 'UYT'],
            ['label' => 'UZT', 'value' => 'UZT'],
            ['label' => 'VET', 'value' => 'VET'],
            ['label' => 'VLAT', 'value' => 'VLAT'],
            ['label' => 'VOLT', 'value' => 'VOLT'],
            ['label' => 'VOST', 'value' => 'VOST'],
            ['label' => 'VUT', 'value' => 'VUT'],
            ['label' => 'WAKT', 'value' => 'WAKT'],
            ['label' => 'WAST', 'value' => 'WAST'],
            ['label' => 'WAT', 'value' => 'WAT'],
            ['label' => 'WEST', 'value' => 'WEST'],
            ['label' => 'WET', 'value' => 'WET'],
            ['label' => 'WIT', 'value' => 'WIT'],
            ['label' => 'WST', 'value' => 'WST'],
            ['label' => 'YAKT', 'value' => 'YAKT'],
            ['label' => 'YEKT', 'value' => 'YEKT'],
        ];

        return $timezones;
    }
}
