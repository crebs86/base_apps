<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SettingStylesRequest extends FormRequest
{

    private $text_options = [
        'inherit',
        'current',
        'transparent',
        'black',
        'white',
        'slate-50',
        'slate-100',
        'slate-200',
        'slate-300',
        'slate-400',
        'slate-500',
        'slate-600',
        'slate-700',
        'slate-800',
        'slate-900',
        'gray-50',
        'gray-100',
        'gray-200',
        'gray-300',
        'gray-400',
        'gray-500',
        'gray-600',
        'gray-700',
        'gray-800',
        'gray-900',
        'zinc-50',
        'zinc-100',
        'zinc-200',
        'zinc-300',
        'zinc-400',
        'zinc-500',
        'zinc-600',
        'zinc-700',
        'zinc-800',
        'zinc-900',
        'neutral-50',
        'neutral-100',
        'neutral-200',
        'neutral-300',
        'neutral-400',
        'neutral-500',
        'neutral-600',
        'neutral-700',
        'neutral-800',
        'neutral-900',
        'stone-50',
        'stone-100',
        'stone-200',
        'stone-300',
        'stone-400',
        'stone-500',
        'stone-600',
        'stone-700',
        'stone-800',
        'stone-900',
        'red-50',
        'red-100',
        'red-200',
        'red-300',
        'red-400',
        'red-500',
        'red-600',
        'red-700',
        'red-800',
        'red-900',
        'orange-50',
        'orange-100',
        'orange-200',
        'orange-300',
        'orange-400',
        'orange-500',
        'orange-600',
        'orange-700',
        'orange-800',
        'orange-900',
        'amber-50',
        'amber-100',
        'amber-200',
        'amber-300',
        'amber-400',
        'amber-500',
        'amber-600',
        'amber-700',
        'amber-800',
        'amber-900',
        'yellow-50',
        'yellow-100',
        'yellow-200',
        'yellow-300',
        'yellow-400',
        'yellow-500',
        'yellow-600',
        'yellow-700',
        'yellow-800',
        'yellow-900',
        'lime-50',
        'lime-100',
        'lime-200',
        'lime-300',
        'lime-400',
        'lime-500',
        'lime-600',
        'lime-700',
        'lime-800',
        'lime-900',
        'green-50',
        'green-100',
        'green-200',
        'green-300',
        'green-400',
        'green-500',
        'green-600',
        'green-700',
        'green-800',
        'green-900',
        'emerald-50',
        'emerald-100',
        'emerald-200',
        'emerald-300',
        'emerald-400',
        'emerald-500',
        'emerald-600',
        'emerald-700',
        'emerald-800',
        'emerald-900',
        'teal-50',
        'teal-100',
        'teal-200',
        'teal-300',
        'teal-400',
        'teal-500',
        'teal-600',
        'teal-700',
        'teal-800',
        'teal-900',
        'cyan-50',
        'cyan-100',
        'cyan-200',
        'cyan-300',
        'cyan-400',
        'cyan-500',
        'cyan-600',
        'cyan-700',
        'cyan-800',
        'cyan-900',
        'sky-50',
        'sky-100',
        'sky-200',
        'sky-300',
        'sky-400',
        'sky-500',
        'sky-600',
        'sky-700',
        'sky-800',
        'sky-900',
        'blue-50',
        'blue-100',
        'blue-200',
        'blue-300',
        'blue-400',
        'blue-500',
        'blue-600',
        'blue-700',
        'blue-800',
        'blue-900',
        'indigo-50',
        'indigo-100',
        'indigo-200',
        'indigo-300',
        'indigo-400',
        'indigo-500',
        'indigo-600',
        'indigo-700',
        'indigo-800',
        'indigo-900',
        'violet-50',
        'violet-100',
        'violet-200',
        'violet-300',
        'violet-400',
        'violet-500',
        'violet-600',
        'violet-700',
        'violet-800',
        'violet-900',
        'purple-50',
        'purple-100',
        'purple-200',
        'purple-300',
        'purple-400',
        'purple-500',
        'purple-600',
        'purple-700',
        'purple-800',
        'purple-900',
        'fuchsia-50',
        'fuchsia-100',
        'fuchsia-200',
        'fuchsia-300',
        'fuchsia-400',
        'fuchsia-500',
        'fuchsia-600',
        'fuchsia-700',
        'fuchsia-800',
        'fuchsia-900',
        'pink-50',
        'pink-100',
        'pink-200',
        'pink-300',
        'pink-400',
        'pink-500',
        'pink-600',
        'pink-700',
        'pink-800',
        'pink-900',
        'rose-50',
        'rose-100',
        'rose-200',
        'rose-300',
        'rose-400',
        'rose-500',
        'rose-600',
        'rose-700',
        'rose-800',
        'rose-900'
    ];

    private $labels = [
        'text' => 'Text',
        'bg' => 'Background',
        'light' => 'Light',
        'dark' => 'Dark',
        'link' => 'TextLink',
        'linkHover' => 'TextLinkHover',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'text_light' => [Rule::requiredIf(fn () => !in_array($this->section, ['innerSectionIcons'])), Rule::in($this->text_options)],
            'bg_light' => [Rule::requiredIf(fn () => !in_array($this->section, ['innerSectionIcons'])), Rule::in($this->text_options)],
            'text_dark' => [Rule::requiredIf(fn () => !in_array($this->section, ['innerSectionIcons'])), Rule::in($this->text_options)],
            'bg_dark' => [Rule::requiredIf(fn () => !in_array($this->section, ['innerSectionIcons'])), Rule::in($this->text_options)],
            'link_light' => [Rule::requiredIf(fn () => !in_array($this->section, ['body', 'container', 'subSection', 'innerSection', 'innerSectionIcons', 'mainMenu'])), Rule::in($this->text_options)],
            'link_dark' => [Rule::requiredIf(fn () => !in_array($this->section, ['body', 'container', 'subSection', 'innerSection', 'innerSectionIcons', 'mainMenu'])), Rule::in($this->text_options)],
            'linkHover_light' => [Rule::requiredIf(fn () => !in_array($this->section, ['body', 'container', 'subSection', 'innerSection', 'innerSectionIcons', 'mainMenu'])), Rule::in($this->text_options)],
            'linkHover_dark' => [Rule::requiredIf(fn () => !in_array($this->section, ['body', 'container', 'subSection', 'innerSection', 'innerSectionIcons', 'mainMenu'])), Rule::in($this->text_options)],
            'textActive_light' => [Rule::requiredIf(fn () => !in_array($this->section, ['body', 'container', 'subSection', 'innerSection', 'innerSectionIcons', 'mainMenu'])), Rule::in($this->text_options)],
            'textActive_dark' => [Rule::requiredIf(fn () => !in_array($this->section, ['body', 'container', 'subSection', 'innerSection', 'innerSectionIcons', 'mainMenu'])), Rule::in($this->text_options)],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'text_light.in' => $this->customMessage('text_light', $this->section),
            'bg_light.in' => $this->customMessage('bg_light', $this->section),
            'text_dark.in' => $this->customMessage('text_dark', $this->section),
            'bg_dark.in' => $this->customMessage('bg_dark', $this->section),
            'link_light.in' => $this->customMessage('link_light', $this->section),
            'link_dark.in' => $this->customMessage('link_dark', $this->section),
            'linkHover_light.in' => $this->customMessage('linkHover_light', $this->section),
            'linkHover_dark.in' => $this->customMessage('linkHover_dark', $this->section),
            'text_light.required' => 'Campo obrigatório',
            'bg_light.required' => 'Campo obrigatório',
            'text_dark.required' => 'Campo obrigatório',
            'bg_dark.required' => 'Campo obrigatório',
            'link_light.required' => 'Campo obrigatório',
            'link_dark.required' => 'Campo obrigatório',
            'linkHover_light.required' => 'Campo obrigatório',
            'linkHover_dark.required' => 'Campo obrigatório',
        ];
    }

    /**
     * @param string $attr
     * @param string $section
     * 
     * @return string
     */
    private function customMessage($attr, $section): string
    {
        $a = explode('_', $attr);
        return 'A classe "' . $this->$attr . '" informada em ' . Str::ucfirst($section) . ' > ' . $this->labels[$a[0]] . ' > ' . $this->labels[$a[1]] . ' não existe';
    }
}
