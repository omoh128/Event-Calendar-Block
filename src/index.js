import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { TextControl, PanelBody, DatePicker } from '@wordpress/components';
import './style.scss';

registerBlockType( 'my-plugin/event-calendar', {
    title: __( 'Event Calendar', 'my-plugin' ),
    description: __( 'A custom block for managing events visually.', 'my-plugin' ),
    icon: 'calendar-alt',
    category: 'common',
    keywords: [ __( 'event', 'my-plugin' ), __( 'calendar', 'my-plugin' ), __( 'schedule', 'my-plugin' ) ],

    attributes: {
        title: {
            type: 'string',
            source: 'html',
            selector: '.event-calendar-title', // CSS class to target the title element
            default: 'Event Calendar',
        },
        description: {
            type: 'string',
            source: 'html',
            selector: '.event-calendar-description', // CSS class to target the description element
            default: 'Explore upcoming events.',
        },
        eventDate: {
            type: 'string',
            default: '',
        },
        venue: {
            type: 'string',
            default: '',
        },
    },

    edit: ( props ) => {
        const { attributes, setAttributes } = props;
        const { title, description, eventDate, venue } = attributes;

        const onChangeTitle = ( newTitle ) => {
            setAttributes( { title: newTitle } );
        };

        const onChangeDescription = ( newDescription ) => {
            setAttributes( { description: newDescription } );
        };

        const onChangeDate = ( newDate ) => {
            setAttributes( { eventDate: newDate } );
        };

        const onChangeVenue = ( newVenue ) => {
            setAttributes( { venue: newVenue } );
        };

        return (
            <div className={ props.className }>
                <PanelBody title={ __( 'Event Calendar Settings', 'my-plugin' ) }>
                    <TextControl
                        label={ __( 'Title', 'my-plugin' ) }
                        value={ title }
                        onChange={ onChangeTitle }
                    />
                    <TextControl
                        label={ __( 'Description', 'my-plugin' ) }
                        value={ description }
                        onChange={ onChangeDescription }
                    />
                    <DatePicker
                        label={ __( 'Event Date', 'my-plugin' ) }
                        selected={ eventDate }
                        onChange={ onChangeDate }
                    />
                    <TextControl
                        label={ __( 'Venue', 'my-plugin' ) }
                        value={ venue }
                        onChange={ onChangeVenue }
                    />
                </PanelBody>
            </div>
        );
    },

    save: ( props ) => {
        const { attributes } = props;
        const { title, description, eventDate, venue } = attributes;

        return (
            <div className="event-calendar">
                <h2 className="event-calendar-title">{ title }</h2>
                <p className="event-calendar-description">{ description }</p>
                <p>Event Date: { eventDate }</p>
                <p>Venue: { venue }</p>
            </div>
        );
    },
} );
