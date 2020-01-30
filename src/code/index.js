import { createHigherOrderComponent } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { addFilter } from '@wordpress/hooks';
import CodeEditor from './CodeEditor'

const languages = [
	'HTML',
	'CSS',
	'JavaScript',
	'SCSS',
	'PHP'
];

const withInspectorControls = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		const { name, attributes, setAttributes, clientId } = props;
		const { language } = attributes;
		if ( name !== 'core/code' ) {
			return <BlockEdit { ...props } />;
		}
		return (
			<>
				<CodeEditor
					mode={ language }
					id={ `editor-${ clientId }` }
					value={ attributes.content }
					onChange={ ( content ) => setAttributes( { content } ) }
					placeholder={ __( 'Write Code…' ) }
					aria-label={ __( 'Code' ) }
				/>
				<InspectorControls>
					<PanelBody title={ 'Highlight Option' }>
						<SelectControl
							label={ __( 'language', 'code-block-syntax-highlight' ) }
							value={ language }
							options={ [
								{
									value: '',
									label: __( 'None (Auto detection)', 'code-block-syntax-highlight' ),
								},
								...languages.map( ( lang ) => ( {
									label: lang,
									value: lang.toLowerCase(),
								} ) ),
							] }
							onChange={ ( value ) => {
								setAttributes( { language: value ? value : undefined } );
							} }
						/>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}, 'withInspectorControls' );

addFilter( 'editor.BlockEdit', 'code-block-syntax-highlight/code/with-inspector-controls', withInspectorControls );

const codeBlockAttributes = ( settings, name ) => {
	if ( name !== 'core/code' ) {
		return settings;
	}
	settings.attributes = {
		...settings.attributes,
		'language': {
			type: 'string',
		},
	};

	return settings;
};

addFilter( 'blocks.registerBlockType', 'code-block-syntax-highlight/code/attributes', codeBlockAttributes );
